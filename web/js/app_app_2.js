$(function() {
    $('.dropdown').dropdown();

    $('.action').click(function() {
        var self = $(this);
        var action = self.data('action');
        var taskId = self.parents('tr').data('task-id');

        if (action == 'edit') {
            $("#todo_form").load(Routing.generate('get_task', { id:
                taskId }), function() {
                $('.dropdown').dropdown();
                $('#task_add').text('Edit Task');
            });
        } else if (action == 'finish') {
            $.ajax({
                url: Routing.generate('finish_task', { id: taskId }),
                method: 'PATCH',
                success: function(data) {
                    if (data.status == 'ok') {
                        self.parents('tr').remove();
                    }
                }
            });
        } else if (action == 'delete') {
            $.ajax({
                url: Routing.generate('delete_task', { id: taskId }),
                method: 'DELETE',
                success: function(data) {
                    if (data.status == 'ok') {
                        self.parents('tr').remove();
                    }
                }
            });
        }

        return false;
    });
});
