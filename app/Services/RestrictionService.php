<?php
namespace App\Services;

use DB;
use Carbon\Carbon;
use App\Utils\Util;
use Illuminate\Http\Request;
use Modules\Accounting\Utils\AccountingUtil;
use Modules\Accounting\Entities\AccountingAccTransMapping;

class RestrictionService {


        /**
     * All Utils instance.
     */

    /**
     * Constructor
     *
     * @return void
     */

    protected $accountingUtil;
    protected $util;

    public function __construct(Util $util, AccountingUtil $accountingUtil)
    {
        $this->util = $util;
        $this->accountingUtil = $accountingUtil;
    }

    
    public function create($type, $transactionId ,$user_id, $business_id, $deposit_to, $payment_account = 5) {
        // try {
              
                // DB::beginTransaction();
               

                // $deposit_to = $request->get('deposit_to');
                // $payment_account = $request->get('payment_account');
            $now = Carbon::now();
            $journal_date = Carbon::createFromTimestamp(strtotime($now))->format('Y-m-d H:i:s');
            // $journal_date = Carbon::now();

            $accounting_settings = $this->accountingUtil->getAccountingSettings($business_id);

            $ref_no = '';
            $ref_count = $this->util->setAndGetReferenceCount('journal_entry');
            if (empty($ref_no)) {
                $prefix = ! empty($accounting_settings['journal_entry_prefix']) ? $accounting_settings['journal_entry_prefix'] : '';

                //Generate reference number
                $ref_no = $this->util->generateReferenceNumber('journal_entry', $ref_count, $business_id, $prefix);
            } 


                $acc_trans_mapping = new AccountingAccTransMapping();
                $acc_trans_mapping->business_id = $business_id;
                $acc_trans_mapping->ref_no = $ref_no;
                // $acc_trans_mapping->note = $request->get('note');
                $acc_trans_mapping->type = 'journal_entry';
                $acc_trans_mapping->created_by = $user_id;
                $acc_trans_mapping->operation_date = $journal_date;
                $acc_trans_mapping->save();

                $this->accountingUtil->saveMap($type, $transactionId, $user_id, $business_id, $deposit_to, $payment_account);

                // DB::commit();

                $output = ['success' => true,'msg' => __('lang_v1.updated_success'),];
            
        // } catch (\Exception $e) {
        //     print_r($e->getMessage());
        //     exit;
        //     DB::rollBack();

            // \Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());

        
        // }
    }


}