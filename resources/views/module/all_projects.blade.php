<!-- 全部项目列表 -->
<!-- 模态框（Modal） -->
<div class="modal fade" id="project_list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">请选择项目</h4>
            </div>
            <div class="modal-body">
                <ul class="list-group" id="project_list">
                    @forelse($projects as $project)
                        <li class="list-group-item" id="{{$project->id}}"><input type="radio" name="checkProject"
                                                                                 value="{{$project->id}}"
                                                                                 style="margin-right: 15px;"><span>{{$project->name}}
                                </span></li>

                    @empty
                        <li class="list-group-item">暂无项目</li>

                    @endforelse
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="setProject">确定</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!-- 执行 -->
@push('javascript')
    <script>
        $(document).ready(function () {
            $('#project_list .list-group-item').click(function () {
                $(this).find("input[name='checkProject']").prop('checked','checked')
            });
            $('#setProject').click(function () {
                let id = $("#project_list input[name='checkProject']:checked").val();
                let project = $('#project_list #' + id).find('span').text();
                if (id) {
                    $('#project_id').val(id);
                    $("input[name='project']").attr('style', 'display:block');
                    $("input[name='project']").val(project);
                    $('#project_list').modal('hide');
                }
            })
        })
    </script>
@endpush