@include('user.include.header')
@include('user.include.sidebar')
<div class="right_col" role="main">
    <div class="row" id="content-heading">
        <div class="col-md-8">
            <h1 class="cust-head">Redeemed Deals</h1>
        </div>
    </div>
    <hr class="border">
    <div class="row" id="pg-content">
{{--        @include('user.error')--}}
        <div class="table-responsive">
            <table class="table table-striped jambo_table">
                <thead>
                <tr>
                    <th scope="col">Deal coupon</th>
                    <th scope="col">Name</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Start Date - Expiry Date</th>
                    <th scope="col">Price</th>
                    <th scope="col">Discount Price</th>
                    {{--<th scope="col">Discount</th>--}}
                    <th scope="col">Status</th>
                    {{--<th scope="col">Action</th>--}}
                </tr>
                </thead>
                <tbody>

                <?PHP
                if(isset($Deals) && count($Deals) > 0){

                foreach ($Deals as $Deal){

                ?>
                <tr>
                    <th>
                        <?PHP echo $Deal->deal_coupon ?>
                    </th>
                    <td scope="row">
                        <?PHP echo $Deal->first_name ?> <?PHP echo $Deal->last_name ?>
                    </td>
                    <td scope="row"><?PHP echo $Deal->title ?></td>
                    <td scope="row">
                        @if(file_exists( public_path().'/uploads/user/'.$Deal->deal_image) && $Deal->deal_image != '')
                            <img width="100px" src="<?PHP echo URL::to('/uploads/user/' . $Deal->deal_image) ?>" alt="">
                        @else

                            <img width="100px" src="<?PHP echo URL::to('/uploads/user/no-image-icon.png') ?>" alt="">
                        @endif
                    </td>
                    <td scope="row"><?PHP echo date('Y-m-d', strtotime($Deal->start_date)) ?>
                        - <?PHP echo date('Y-m-d', strtotime($Deal->expiry_date)) ?></td>
                    <td>
                        <?PHP echo $Deal->price?>
                    </td>
                    <td><?PHP echo $Deal->discount_price?></td>
                    <td>
                        {{ $Deal->deal_status }}
                    </td>
                </tr>
                <?PHP } ?>
                <?PHP } ?>
                </tbody>
            </table>
            <?PHP echo $Deals->links() ?>
        </div>
    </div>


    <script type="text/javascript">

    </script>

</div>
@include('user.include.footer')