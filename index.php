<?php

include_once 'header.php';
?>
<style type="text/css">
    .cover-image{
        width:120px !important;
    }
    .cover-container{
        margin-top: 35%;
    }
    .whats-new-heading{
        font-size: 18px !important;
        color: black !important;
    }
    .details-section-contents .content{
        padding: 0px !important;
    }
    .details-section-contents .title{
        font-weight: 600 !important;
    }


    .meta-info {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        display: inline-block;
        padding: 10px 15px 10px 0;
        text-align: left;
        vertical-align: top;
        width: 170px
    }
    .meta-info-wide {
        width: 340px
    }
    .meta-info .title {
        color: #333;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 2px
    }
    .meta-info .content,
    .meta-info .category,
    .meta-info .dev-link {
        font-size: 14px;
        font-weight: 300
    }
    .meta-info .category,
    .meta-info .dev-link {
        display: block
    }
    .meta-info .content .meta-img {
        height: 25px;
        width: 25px
    }
    .meta-info .content .meta-description {
        vertical-align: middle
    }
    .meta-info .content .physical-address {
        white-space: pre-wrap
    }
    .contains-text-link a,
    .contains-text-link a:visited,
    .text-body a,
    .text-body a:visited,
    .fake-link {
        color: #15c;
        cursor: pointer
    }
    .contains-text-link a:hover,
    .fake-link:hover {
        text-decoration: underline
    }
    .contains-text-link a,
    .contains-text-link a:visited,
    .text-body a,
    .text-body a:visited,
    .fake-link {
        color: #15c;
        cursor: pointer
    }
    .contains-text-link a:hover,
    .fake-link:hover {
        text-decoration: underline
    }
    .no-focus-outline button {
        outline: none
    }
    button {
        -webkit-box-sizing: initial;
        box-sizing: initial;
        -webkit-font-smoothing: inherit;
        -webkit-align-items: initial;
        align-items: initial;
        background: none;
        border: 0;
        -webkit-box-sizing: initial;
        box-sizing: initial;
        color: inherit;
        font: inherit;
        margin: 0;
        padding: 0;
        text-align: inherit
    }
</style>
<div class="row">
    <div class="box box-primary">
        <form name="search" method="post" id="search">
            <div class="box-body">
                <div class="row" style="margin-top:10px; margin-bottom:10px">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-10" style="padding-right:0px">
                                <input type="text"  name="search_text" class="form-control searchBox"  value="" />
                            </div>
                            <div class="col-md-2" style="padding-left:0px">
                                <input type="submit" name="submit" value="Submit" id="submit" class="btn btn-sm btn-danger form-control" placeholder="https://play.google.com/store/apps/details?id=google.app"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="box box-info" style="display: none;">
        <div class="box-body resultDiv">
            <div class="header">
                <div class="col-md-12">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="col-md-2">
                            <div class="app-header-image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="app-header-heading">
                            </div>
                            <div class="top-developer hide">
                                <img aria-hidden="true" src="https://lh3.ggpht.com/STkLA3lthJ3mrb1mScEIdKgag30BABVWAz3m-zTnwTeUShZIZz8fAkQR0tgCe4GLSEY=w14">
                                <span class="badge-title">Top Developer</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            <div class="col-md-12" style="height:20px"></div>
            <div class="discription">
                <div class="col-md-12">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="panel panel-default hide">
                            <div class="panel-body">
                                <div class="app-discription"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            <div class="col-md-12" style="height:20px"></div>
            <!-- <div class="col-md-12">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="app-ratings">
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div> -->
            <div class="col-md-12" style="height:20px"></div>
            <div class="col-md-12">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="col-md-12">
                        <h1 class="whats-new-heading hide"></h1>
                    </div>
                    <div class="col-md-12" style="height:10px"></div>
                    <div class="col-md-12">
                        <div class="app-whats-new">
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="col-md-12" style="height:20px"></div>
            <div class="aditional-info">
                <div class="col-md-12">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="panel panel-default hide">
                            <div class="panel-body">
                                <div class="app-aditional-info" style="background-color: #f9f9f9"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
        <div class="test">

        </div>
        <div class="ajaxLoader" style="display: none;"> <img src="img/ajax-loader.gif" /> </div>
    </div>
</div>



<script type="text/javascript">
    (function ($, window) {
        function section1scraping(data) {
            $(".app-header-image").html(data.datas['appHeadImage']);
            $(".app-header-heading").html(data.datas['appHeadTitle']);
            $(".app-discription").html(data.datas['appDiscription']);
            $(".app-ratings").html(data.datas['appRatings']);
            $(".test").html(data.datas['test']);
            $(".app-whats-new").html(data.datas['appWhatsNew']);
            $(".app-aditional-info").html(data.datas['appAditionalInfo']);
            $(".details-section-body").addClass("hide");
            $(".details-section-divider").addClass("hide");
            $(".apps-secondary-color").addClass("hide");
            $(".show-more-end").addClass("hide");
            $(".play-button").addClass("hide");
            $(".top-developer").removeClass("hide");
            $(".panel").removeClass("hide");
            $(".whats-new-heading").removeClass("hide");
        }

        function formAutoFill(data) {
            $(".app-name").val(data.datas['formArray']['formName']);
            $(".app-catagory").val(data.datas['formArray']['formCatagory']);
            $(".app-user-ratings").val(data.datas['formArray']['formTotalReviews']);
            $(".app-star-ratings").val(data.datas['formArray']['formStarRatings']);
            $(".app-total-instals").val(data.datas['formArray']['formTotalInstals']);
            $(".app-os").val('android');
            $(".app-os").attr('disabled', true);
            $(".form-class").removeClass("hide");
        }

        $('#search').submit(function (el) {
            //        $('#submit').click(function (el) {
            $('.box-info').css('display', 'inline-block');
            $('.ajaxLoader').show();
            el.preventDefault();
            var objD = $(this).parent().data('searchObj');

            var srtOrdr = (typeof objD === "object") ? objD.sortOrder : 'D';
            var formData = $(this).serialize();
            $.ajax({
                url: 'includes/ajaxSearch.php',
                type: 'post',
                data: formData + '&so=' + srtOrdr,
                dataType: 'json',
                success: function (data) {
                    $('.ajaxLoader').hide();
                    if (data.error === true) {
                        $('.resultDiv').html(data.msg);
                        return false;
                    } else {
                        section1scraping(data);
                        $(".rating-histogram").addClass("hide");
                        // formAutoFill(data);
                    }
                }
            });
        });
    })($, window);
</script>

<?php

include_once 'footer.php';
