<!-- 全部项目列表 -->
<!-- 模态框（Modal） -->
<div class="modal fade" id="step_list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">请选择阶段</h4>
            </div>
            <div class="modal-body">
                <ul class="list-group" id="step_list">
                    @forelse($steps as $step)
                        <li class="list-group-item" id="{{$step->id}}"><input type="radio" name="checkStep"
                                                                              value="{{$step->id}}"
                                                                              style="margin-right: 15px;"><span>{{$step->name}}
                                </span></li>

                    @empty
                        <li class="list-group-item">暂无项目</li>

                    @endforelse
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="setStep">确定</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!-- 执行 -->
@push('javascript')
    <script>
        $(document).ready(function () {
            $('#step_list .list-group-item').click(function () {
                $(this).find("input[name='checkStep']").prop('checked','checked')
            });
            $('#setStep').click(function () {
                let id = $("#step_list input[name='checkStep']:checked").val();
                let project = $('#step_list #' + id).find('span').text();
                if (id) {
                    $('#step_id').val(id);
                    $("input[name='step']").attr('style', 'display:block');
                    $("input[name='step']").val(project);
                    $('#step_list').modal('hide');
                }
            })
        })
    </script>
@endpush