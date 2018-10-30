<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<style>
    .preview-image-box {
        position: relative;
        width: 250px;
        height: 250px;
        border: 1px solid #EAEAEA;
        background-color: #EAEAEA;
    }

    .inside-image-box {
        position: absolute;
        width: 250px;
        height: 250px;
    }

    .uploaded-image {
        position: absolute;
        width: 250px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .loading-shadow {
        position: absolute;
        top: 0;
        left: 0;
        width: 250px;
        height: 250px;
        display: none;
        background-color: rgba(255, 255, 255, 1);
    }

    .loading-shadow img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .loading-shadow.active{
        display: block;
    }

    .js-reset-image {
        width: 250px;
        color: #274A91;
        text-align: center;
        margin-top: 20px;
    }

    .js-reset-image span {
        display: none;
        cursor: pointer;
    }

    .js-reset-image span.on {
        display: inline;
    }

    .loading-icon img {
        width: 150px;
    }
</style>
<div class="container">
    <div class="preview-image-box">
        <div class="inside-image-box">
            <img class="uploaded-image" src="" alt="">
        </div>
        <div class="loading-shadow">
            <div class="loading-icon">
                <img src="http://www.muyesanren.com/loading.gif" alt="">
            </div>
        </div>
    </div>
    <div class="js-reset-image">
        <span class="upload-text on">上传</span>
        <span class="re-upload-text">重新上传</span>
    </div>
    <form id="uploadForm" action="{{route('upload')}}" method="post">
    {{csrf_field()}}
    <input style="display: none;" name="image" type="file" class="inputFile" />
    </form>
</div>

<script type="text/javascript">
    $(function (e) {
        $("#uploadForm").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{route('upload')}}",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                // 显示加载图片
                beforeSend: function () {
                    $('.loading-shadow').addClass('active');
                },
                success: function (data) {
                    // 移除loading加载图片
                    $('.loading-shadow').removeClass('active');
                    // 看我接下来的解释
                    $('.uploaded-image').attr('src',   data.msg);
                    // 更换上传提示文本为重新上传
                    $('.upload-text').removeClass('on');
                    $('.re-upload-text').addClass('on');
                },
                error: function(){}
            });
        });

        // 选择完要上传的文件后, 直接触发表单提交
        $('input[name=image]').on('change', function () {
            // 如果确认已经选择了一张图片, 则进行上传操作
            if ($.trim($(this).val())) {
                $("#uploadForm").trigger('submit');
            }
        });

        // 触发文件选择窗口
        $('.js-reset-image span').on('click', function () {
            $('input[name=image]').trigger('click');
        });
    });
</script>
