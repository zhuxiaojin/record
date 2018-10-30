<!-- 全部用户列表 -->
<!-- 模态框（Modal） -->
<div class="modal fade" id="versions_list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">请选择版本</h4>
            </div>
            <div class="modal-body">
                <ul class="list-group" id='versions_ul'>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="setVersion">确定</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!-- 执行 -->
@push('javascript')
    <script>
        $(document).ready(function () {
            $('#versions_list .list-group-item').click(function () {
                $(this).find("input[name='checkVersion']").prop('checked', 'checked')
            });
            $('#setVersion').click(function () {
                let id = $("#versions_list input[name='checkVersion']:checked").val();
                let versions = $('#versions_list #' + id).find('span').text();
                if (id) {
                    $('#version_id').val(id);
                    $("input[name='version']").attr('style', 'display:block');
                    $("input[name='version']").val(versions);
                    $('#versions_list').modal('hide')
                }
            })
        })
    </script>
@endpush