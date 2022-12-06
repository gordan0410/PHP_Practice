$(function () {
    $('.hide_btn').click(function() {
        $('.hide_tbody').fadeToggle()
    })
    $('.delete_btn').click(function() {
        var id = $(this).attr('id')
        $.ajax({
            url: 'index.php?data=home/delete/'+id,
            // data: {
            //     'student_id': id,
            // },
            method: 'get',
            cache: false,
            // dataType: 'json',
            success: function (data) {
                console.log(data)
                if (data.event) {
                    alert("刪除成功")
                } else {
                    alert("刪除失敗")
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("刪除失敗")
            }
        });
    })
});