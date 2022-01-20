'use strict';

let tableName = '#blogTbl';
$(tableName).DataTable({
    scrollX: false,
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: blogUrl,
    },
    columnDefs: [
        {
            'targets': [0],
            'width': '20%',
        },
        {
            'targets': [1],
            render: function (data) {
                return data.length > 100 ?
                    data.substr(0, 100) + '...' :
                    data;
            },
        },
        {
            'targets': [2],
            'orderable': false,
            'className': 'text-center',
            'width': '8%',
        },
    ],
    columns: [
        {
            data: function (row) {
                let element = document.createElement('textarea');
                element.innerHTML = row.title;
                let showUrl = blogUrl + '/' + row.id;
                return '<a href="' + showUrl + '" class="show-btn" data-id="' +
                    row.id +
                    '">' + element.value + '</a>';
            },
            name: 'title',
        },
        {
            data: function (row) {
                if (!isEmpty(row.description)) {
                    let element = document.createElement('textarea');
                    element.innerHTML = row.description;
                    return element.value;
                } else
                    return 'N/A';
            },
            name: 'description',
        },
        {
            data: function (row) {
                let url = blogUrl + '/' + row.id;
                let data = [
                    {
                        'id': row.id,
                        'url': url + '/edit',
                    }];
                return prepareTemplateRender('#blogActionTemplate',
                    data);
            }, name: 'id',
        },
    ],
});

$(document).on('click', '.btnDeletePost', function (event) {
    let postId = $(this).attr('data-id');
    swal({
            title: Lang.get('messages.common.delete') + ' !',
            text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' +
                Lang.get('messages.post.post') + '" ?',
            type: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#6777ef',
            cancelButtonColor: '#d33',
            cancelButtonText: Lang.get('messages.common.no'),
            confirmButtonText: Lang.get('messages.common.yes'),
        },
        function () {
            window.livewire.emit('deletePost', postId);
        });
});

document.addEventListener('delete', function () {
    swal({
        title: Lang.get('messages.common.deleted') + ' !',
        text: Lang.get('messages.post.post') +
            Lang.get('messages.common.has_been_deleted'),
        type: 'success',
        confirmButtonColor: '#6777ef',
        timer: 2000,
    });
});

let loadStretchy;
$(document).ready(function () {
    $('#filterCategory').select2({
        width: '100%',
    });

    loadStretchy = () => {
        if ($('.cd-stretchy-nav').length > 0) {
            $(document).on('click', '.cd-nav-trigger', function () {
                let stretchyNav = $(this).closest('nav');
                if (stretchyNav.hasClass('nav-is-visible')) {
                    stretchyNav.removeClass('nav-is-visible');
                } else {
                    $('.cd-stretchy-nav').removeClass('nav-is-visible');
                    stretchyNav.addClass('nav-is-visible');
                }
            });
            $(document).on('click', function (event) {
                (!$(event.target).is('.cd-nav-trigger') &&
                    !$(event.target).is('.cd-nav-trigger span')) &&
                $('.cd-stretchy-nav').removeClass('nav-is-visible');
            });
        }
    };

    loadStretchy();
});

let filterCategoryId = null;

document.addEventListener('livewire:load', function () {
    window.livewire.hook('message.processed', () => {
        $('#filterCategory').select2({
            width: '100%',
        });
        $('#filterCategory').val(filterCategoryId).trigger('change.select2');
    });
});

$(document).on('change', '#filterCategory', function () {
    filterCategoryId = $(this).val();
    window.livewire.emit('filterPost', $(this).val());
});

