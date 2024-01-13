<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainAccount extends Model
{
    use HasFactory;

    protected $table = 'main_accounts';
    protected $guarded = ['id'];

    // get all parent account and get root 
    public static function tree()
    {
        $business_id = request()->session()->get('user.business_id');
        $allaccounts = MainAccount::where('business_id',$business_id)
        ->withCount(['accountingAccountsTransactions as balance' => function($query) {
            $query->select(DB::raw("SUM(IF(type='credit', amount, -1 * amount)) AS balance"));
        }
        ])->get();
        $rootAccounts = $allaccounts->whereNull('parent_id');
        self::formatTree($rootAccounts, $allaccounts);
        return $rootAccounts;
    }

    // loop through root of childern
    private static function formatTree($accounts, $allaccounts)
    {
        foreach ($accounts as $account) {
            $account->children = $allaccounts->where('parent_id', $account->id)->values();
            $account->totalBalance = $account->balance;
            if ($account->children->isNotEmpty()) {
                self::calculateTotalBalance($account->children, $allaccounts);
                self::formatTree($account->children, $allaccounts);
                $account->totalBalance += $account->children->sum('totalBalance');
            }
        }
    }

    // Initialize totalBalance with the current account's balance
    private static function calculateTotalBalance($accounts, $allaccounts)
    {
        foreach ($accounts as $account) {
            $account->totalBalance = $account->balance; 

            if ($account->children) {
                self::calculateTotalBalance($account->children, $allaccounts);
                $account->totalBalance += $account->children->sum('totalBalance');
            }
        }
    }

   public function isChild(): bool
   {
        return $this->parent_id !== null;
   }

    public function isParent() {
            return $this->hasMany(MainAccount::class, 'parent_id');
    }

    public function child_accounts() {
        return $this->hasMany(MainAccount::class, 'parent_id');
    }
    

    public function accountingAccountsTransactions() {
        return $this->hasMany(\Modules\Accounting\Entities\AccountingAccountsTransaction::class, 'accounting_account_id');
    }

    public function sumBalanceOfChildren() {
        $business_id = request()->session()->get('user.business_id');
        $sum = MainAccount::where('business_id',$business_id)->where('parent_id', $this->id)
                ->with('accountingAccountsTransactions')
                ->withCount(['accountingAccountsTransactions as balance' => function($query) {
                $query->select(DB::raw("SUM(IF(type='credit', amount, -1 * amount)) AS balance"));
                }])->get();
        return $sum->sum('balance');
    }

   public function sumBalanceOfChildrenTwo() {
        $business_id = request()->session()->get('user.business_id');
        $parentsAccIds = MainAccount::with('child_accounts')->where('business_id',$business_id)->whereNull('parent_id')->pluck('id');
        $sum = MainAccount::where('business_id',$business_id)->whereIn('parent_id', $parentsAccIds)
                ->with('accountingAccountsTransactions')
                ->withCount(['accountingAccountsTransactions as balance' => function($query) {
                $query->select(DB::raw("SUM(IF(type='credit', amount, -1 * amount)) AS balance"));
                }])->get();
        return $sum->sum('balance');
    }

    /**
     * main Accounts Dropdown 
     *
     * @param  int  $business_id
     * @return array
    */
    public static function forDropdown($business_id, $with_data = false, $q = '')
    {
        $query = MainAccount::where('business_id', $business_id)->whereNotNull('parent_id')
                            ->whereDoesntHave('child_accounts')
                            ->where('status', 'active');
        if ($with_data) {
            if (! empty($q)) {
                $query->where('name_ar', 'like', "%{$q}%")->orWhere('name_en', 'like', "%{$q}%");
            }
            return $query->get();
        } else {
            return $query->pluck('name_ar', 'name_en', 'id');
        }
    }

}
