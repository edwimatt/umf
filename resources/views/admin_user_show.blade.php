<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your html goes here -->

    <a class="btn btn-sm btn-primary" href="{{ url('/admin/physicians') }}">Back</a>


    <div class='panel panel-default'>

        <div class='panel-heading'>View Details</div>
        <div class='panel-body'>

            {{ csrf_field() }}

                <div class='form-group'>
                    <label>User Details</label>
                    <h4> <?PHP echo $result[0]->first_name ?> <?PHP echo $result[0]->last_name ?> - (<?PHP echo $result[0]->email ?>) </h4>
                </div>
            <div class='form-group'>
                <label>Mobile No</label>
                <h4> <?PHP echo $result[0]->mobile_no ?> </h4>
            </div>

            <div class='form-group'>
                <label>Department</label>
                <h4> <?PHP echo $result[0]->title ?> </h4>
            </div>

            <div class='form-group'>
                <label>Hospital</label>
                <h4> <?PHP echo $result[0]->name ?> </h4>
            </div>

            <div class='form-group'>
                <label>Approve Status</label>
                <?PHP
                if($result[0]->is_approved == 1){
                ?>
                <h4>  Approved </h4>
                <?PHP } else {
                $path = CRUDBooster::mainpath('user-approve/'.$user_id);
                    echo "<a onclick=\"return confirm('Are you sure you want to Approve?')\" href='".$path."'>Approve<a/>";
                    ?>

                <?PHP } ?>
            </div>

        </div>

        </div>

    <?PHP
    if(isset($PlanHistory) && count($PlanHistory) > 0){
    ?>
    <div class='panel panel-default'>

        <div class='panel-heading'>Payment Details</div>
        <div class='panel-body'>
            <table id="table_dashboard" class="table table-hover table-striped table-bordered">

                <tr>
                    <th>
                        Gateway Type
                    </th>
                    <th>
                        gateway response
                    </th>

                    <th>
                        gateway request
                    </th>
                </tr>
            <?PHP
            if(isset($PlanHistory) && count($PlanHistory) > 0){
                //dd($PlanHistory);
                foreach ($PlanHistory as $PlanHistoryItem){
                ?>
                <tr>
                    <td>
                        <?PHP
                        echo $PlanHistoryItem->gateway_type
                        ?>

                    </td>
                    <?PHP
                    if($PlanHistoryItem->gateway_type == "apple-pay"){
                    ?>
                      <td>
                        <?PHP
                         $data = ((array)json_decode($PlanHistoryItem->gateway_response));
                         $gateway_request_data = ((array)json_decode($PlanHistoryItem->gateway_request));
                         //dd($gateway_request_data);
                        ?>

                        <table>
                            <tr>
                                <td>
                                    Quantity
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $data['quantity']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Product
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $data['product_id']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Transaction id
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $data['transaction_id']?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Original transaction id
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $data['original_transaction_id']?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Purchase date
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $data['purchase_date']?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Purchase date pst
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $data['purchase_date_pst']?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Expires date
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $data['expires_date']?>
                                </td>
                            </tr>
                        </table>


                    </td>
                    <?PHP }?>

                    <?PHP
                    if($PlanHistoryItem->gateway_type == "apple-pay"){
                    ?>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    Product Id
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $gateway_request_data['productId']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Description
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $gateway_request_data['description']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Title
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $gateway_request_data['title']?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Localized price
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $gateway_request_data['localizedPrice']?>
                                </td>
                            </tr>



                            <tr>
                                <td>
                                    Price
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $gateway_request_data['price']?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Subscription Period Unit IOS
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $gateway_request_data['subscriptionPeriodUnitIOS']?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Currency
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $gateway_request_data['currency']?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <?PHP }?>



                    <?PHP
                    if($PlanHistoryItem->gateway_type == "google-pay"){
                    ?>
                    <td>
                        <?PHP
                        $data = ((array)json_decode($PlanHistoryItem->gateway_response));
                        $gateway_request_data = ((array)json_decode($PlanHistoryItem->gateway_request));


                        $transactionReceiptData = ((array)$data['transactionReceipt']);
                        $transactionReceiptData2 = ((array)$transactionReceiptData[0]);
                        $transactionReceiptData2 = $transactionReceiptData2[0];
                        $transactionReceiptData2 = ((array)json_decode($transactionReceiptData2));

                        ?>

                        <table>

                            <tr>
                                <td>
                                    Product
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $data['productId']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Transaction id
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $data['transactionId']?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    order Id
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $data['orderId']?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Purchase date
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $data['purchase_date']?>
                                </td>
                            </tr>



                            <tr>
                                <td>
                                    Expires date
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $data['expires_date']?>
                                </td>
                            </tr>

                        </table>


                    </td>
                    <?PHP }?>

                    <?PHP
                    if($PlanHistoryItem->gateway_type == "google-pay"){
                        //dd($gateway_request_data);
                    ?>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    Product Id
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $gateway_request_data['productId']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Description
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $gateway_request_data['description']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Title
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $gateway_request_data['title']?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Localized price
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $gateway_request_data['localizedPrice']?>
                                </td>
                            </tr>



                            <tr>
                                <td>
                                    Price
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $gateway_request_data['price']?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Title
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $gateway_request_data['title']?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Currency
                                </td>
                                <td>
                                    &nbsp;&nbsp;<?PHP echo $gateway_request_data['currency']?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <?PHP }?>



                </tr>

                <?PHP } ?>
                <?PHP } ?>

            </table>

        </div>

    </div>
    <?PHP } ?>
@endsection

