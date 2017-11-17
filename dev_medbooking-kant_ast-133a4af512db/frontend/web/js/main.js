$(function () {
    initPlayerHandles();

    $('.load_panel').on('click',function(){
        $('.csv_container').toggle('slow');
    });
    $('.disabled').on('click',function(){
        return false;
    });
});

function initPlayerHandles() {
    $('.player[data-file]').on('click', function (e) {
        var $this = $(this);
        e.preventDefault();
        $('table tr').removeClass('playing');
        $(this).closest('tr').addClass('playing');
        var player = $('audio#player');
        if ($this.find('span:first').hasClass('fa-pause-circle')) {
            player[0].pause();
        } else {
            if (player.attr('source') == $(this).data('file')) {
                player[0].play();
            } else {
                // $.post("/pami-client/play-call?f=" + $(this).data('file'), function (data) {
                    player.show().attr('src', $(this).data('file')).attr('source', $this.data('file')).attr('data-id', $this.data('id'));
                // });
            }
        }
    });

    var player = $('audio#player').on('loadstart', function () {
    }).on('playing', function () {
        $('.player[data-file]').find('span:first').removeClass('fa-pause-circle');
        $('.player[data-file="' + player.attr('source') + '"]').find('span:first').addClass('fa-pause-circle');
    }).on('pause', function () {
        $('.player[data-file]').find('span:first').removeClass('fa-pause-circle');
    }).on('ended', function () {
        setListen(player.attr('data-id')).success(function () {
            loadModalRecordList($('#player-list').attr('data-id'));
        });
    });

}

$('#player-list').on('show.bs.modal', function (e) {
    var id = $(e.relatedTarget).data('phone');
    var date = $(e.relatedTarget).data('date');
    $('#player-list').attr('data-id', id).find('.modal-body').html('<div class="text-center">Загрузка...</div>');
    loadModalRecordList(id, date);
}).on('hide.bs.modal', function (e) {
    if ($('audio#player')[0]) {
        $('audio#player')[0].pause();
    }
});

function loadModalRecordList(id, date) {
    var content = $('#player-list .modal-body');
    $.get('/cdr/modal', {
        'Cdr2Search[searchPhone]': id,
        'Cdr2Search[approximate_date]': date
    }).success(function (response) {
        // $.get('/record-direct-clinic-call-ref', {'RecordDirectClinicCallRefSearch[record_id]': id}).success(function (response) {
        content.html(response);
        initPlayerHandles();
    }).error(function () {
        content.html('Не удалось загрузить записи');
    });
}

function setListen(id) {
    return $.post('/record-direct-clinic-call-ref/update?id=' + id, {'RecordDirectClinicCallRef[listen]': 1});
}