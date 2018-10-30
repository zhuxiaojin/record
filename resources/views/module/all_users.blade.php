<!-- 全部用户列表 -->
<!-- 模态框（Modal） -->
<div class="modal fade" id="user_list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">请选择用户</h4>
            </div>
            <div class="modal-body">
                <ul class="list-group" id='user_list'>
                    @forelse($users as $user)
                        <li class="list-group-item" id="{{$user->id}}"><input type="radio" name="checkUser"
                                                                              value="{{$user->id}}"
                                                                              style="margin-right: 15px;"><span>{{$user->name}}
                                - {{$user->duty->name}}</span></li>

                    @empty
                        <li class="list-group-item">暂无用户</li>

                    @endforelse
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="setManager">确定</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!-- 执行 -->
@push('javascript')
    <script>
        $(document).ready(function () {
            $('#user_list .list-group-item').click(function () {
                $(this).find("input[name='checkUser']").prop('checked','checked')
            });
            $('#setManager').click(function () {
                let id = $("#user_list input[name='checkUser']:checked").val();
                let user = $('#user_list #' + id).find('span').text();
                if (id) {
                    $('#user_id').val(id);
                    $("input[name='manager']").attr('style', 'display:block');
                    $("input[name='manager']").val(user);
                    $('#user_list').modal('hide')
                }
            })
        })
    </script>
@endpush