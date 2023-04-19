@include('user.include.header')
@include('user.include.sidebar')
<link rel="stylesheet" href="{{ asset('/assets/chat/chat.css') }}">
<style>
    .display-sidebar-chat {
        opacity: 1 !important;
    }
    .fs-class {
        font-size: 16px !important;
        margin-bottom: 0.25rem;
    }
    .media-class {
        margin-bottom: 2rem;
    }
    .mbody-class {
        vertical-align: bottom;
    }
    .fontsize-class {
        font-size: 17px;
    }
    .igdisplay-class {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -ms-flex-align: stretch;
        align-items: stretch;
        width: 100%;
    }
    .fc-class {
        position: relative !important;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        width: 80% !important;
        min-width: 0;
        margin-bottom: 0;
    }
    .igp-class {
        display: flex;
        display: -ms-flexbox;
        margin-left: -1px;
    }
    .iptext-class {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding: .375rem .75rem;
        margin-bottom: 0;
        font-size: 1.5rem;
        font-weight: 400;
        line-height: 1.5;
        text-align: center;
        white-space: nowrap;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        border-radius: .25rem;
    }
</style>
<div class="right_col" role="main">
<div class="row" id="content-heading">
<div class="col-md-12">
            <h1 class="cust-head">Messages</h1>
        </div>
        </div>
        <hr class="border">
        <div class="row" id="pg-content">
            <div id="content" class="p-4">
                <div class="row">
                    <div class="col-md-4 media-class">
                        <div class="inbox">
                            <?/*this is addition*/?>
                            <div class="media media-class">
<!--                                <div class="media-left">
                                    <a href="#">
                                    <img class="media-object active-user" src="https://localhost/client_scope_web_api/public/images/user-placeholder.png" alt="...">
                                    </a>
                                </div>-->
<!--                                <div class="media-body mbody-class">
                                    <h5 class="active-username media-heading fs-class">Team Lead</h5>
                                    <p class="ft-14">teamlead@yopmail.com</p>
                                </div>-->
                            </div>
                            <div class="input-group media-class">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
                                {{--<input type="text" class="form-control" placeholder="Find People and Conversation" aria-describedby="basic-addon1">--}}
                                <input type="search" name="search" class="form-control autocomplete" placeholder="Find people and conversation"  autocomplete="off">
                            </div>
                            <!-- <div class="input-group mb-3">
                                <input type="search" name="search" class="form-control autocomplete" placeholder="Find people and conversation"  autocomplete="off">
                            </div> -->
                            <ul class="nav nav-pills media-class" id="pills-tab" role="tablist">
                                <li class="nav-item " role="presentation">
                                    <a class="nav-link active fontsize-class" id="pills-recent-tab" data-toggle="pill" href="#pills-recent" role="tab" aria-controls="pills-recent" aria-selected="true">Recent Chat</a>
                                </li>
                              {{--  <li class="nav-item" role="presentation">
                                    <a class="nav-link" i+d="pills-groups-tab" data-toggle="pill" href="#pills-groups" role="tab" aria-controls="pills-groups" aria-selected="false">Group <i data-toggle="modal" id="tooltip" data-toggle="tooltip" data-placement="top" title="Add Group" data-target="#addGroup" class="fa fa-plus-circle pl-1"></i></a>
                                </li>--}}
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active display-sidebar-chat" id="pills-recent" role="tabpanel" aria-labelledby="pills-recent-tab">
                                    <div id="recent_chat"></div>
                                </div>
                                <div class="tab-pane fade"s id="pills-unread" role="tabpanel" aria-labelledby="pills-unread-tab">...</div>
                                <div class="tab-pane fade" id="pills-groups" role="tabpanel" aria-labelledby="pills-groups-tab">

                                    <div id="recent_group"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 mb-3">
                        <div class="chats">
                            <div class="active-chat-user" id="active_chat_user_name">
                                Chat Room
                                <hr/>
                            </div>
                            <div data-receiver="0" class="chat-box"></div>
                            <div id="start_typing" class="row send-message"></div>
                            <div class="message-box">
                                <div class="input-group igdisplay-class media-class">
                                    <textarea maxlength="1000" max="1000" class="form-control fc-class chat_message" name="chat_message" placeholder="Message here" style="border:none;resize: none;"></textarea>
                                    <input type="file" name="attachment" id="attachment" accept="image/*" style="display:none;" />
                                    <div class="input-group-append igp-class selectAttachment">
                                        <span class="input-group-text iptext-class" style="border:none;">
                                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                                    </span>
                                    </div>
                                    <div class="input-group-append igp-class send_message">
                                        <span class="input-group-text iptext-class" style="border:none;"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>



    <script src="https://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/chat/admin//js/function.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="{{ asset('assets/chat/chat.js') }}"></script>

</div>
@include('user.include.footer')