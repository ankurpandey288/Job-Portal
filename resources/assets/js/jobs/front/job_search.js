$(window).scrollTop(0);

$(document).ready(function () {
    let salaryFromSlider = $('#salaryFrom');
    let salaryToSlider = $('#salaryTo');
    let jobExperienceSlider = $('#jobExperience');
    $(document).on('change', '.jobType', function () {
        let jobType = [];
        $('input:checkbox[name=job-type]:checked').each(function () {
            jobType.push($(this).val());
        });
        if (jobType.length > 0) {
            window.livewire.emit('changeFilter', 'types', jobType);
        } else {
            window.livewire.emit('resetFilter');
        }
    });

    $('#jobExperience').ionRangeSlider({
        type: 'single',
        min: 0,
        step: 1,
        max: 30,
        max_postfix: '+',
        skin: 'round',
        onFinish: function (data) {
            window.livewire.emit('changeFilter', 'jobExperience', data.from);
        },
    });

    salaryFromSlider.ionRangeSlider({
        type: 'single',
        min: 0,
        step: 100,
        max: 150000,
        max_postfix: '+',
        skin: 'round',
        onFinish: function (data) {
            window.livewire.emit('changeFilter', 'salaryFrom', data.from);
        },
    });

    salaryToSlider.ionRangeSlider({
        type: 'single',
        min: 0,
        step: 100,
        max: 150000,
        max_postfix: '+',
        skin: 'round',
        onFinish: function (data) {
            window.livewire.emit('changeFilter', 'salaryTo', data.from);
        },
    });

    $('#searchCategories').on('change', function () {
        window.livewire.emit('changeFilter', 'category', $(this).val());
    });

    $('#searchSkill').on('change', function () {
        window.livewire.emit('changeFilter', 'skill', $(this).val());
    });

    $('#searchGender').on('change', function () {
        window.livewire.emit('changeFilter', 'gender', $(this).val());
    });

    $('#searchCareerLevel').on('change', function () {
        window.livewire.emit('changeFilter', 'careerLevel', $(this).val());
    });
    
    $('#searchFunctionalArea').on('change', function () {
        window.livewire.emit('changeFilter', 'functionalArea', $(this).val());
    });

    if (input.location != '') {
        $('#searchByLocation').val(input.location);
        window.livewire.emit('changeFilter', 'searchByLocation',
            input.location);
    }

    if (input.keywords != '') {
        window.livewire.emit('changeFilter', 'title', input.keywords);
    }

    $(document).on('click', '.reset-filter', function () {
        window.livewire.emit('resetFilter');
        salaryFromSlider.data('ionRangeSlider').update({
            from: 0,
            to: 0,
        });
        salaryToSlider.data('ionRangeSlider').update({
            from: 0,
            to: 0,
        });
        jobExperienceSlider.data('ionRangeSlider').update({
            from: 0,
            to: 0,
        });
        $('#searchFunctionalArea').val('default').selectpicker('refresh');
        $('#searchCareerLevel').val('default').selectpicker('refresh');
        $('#searchGender').val('default').selectpicker('refresh');
        $('#searchSkill').val('default').selectpicker('refresh');
        $('#searchCategories').val('default').selectpicker('refresh');
        $('.jobType').each(function () {
            $(this).prop('checked', false);
        });
    });
    if ($(window).width() > 991) {
        $('#search-jobs-filter').show();
        $('#collapseBtn').hide();
    } else {
        $('.job-post-sidebar').hide();
        $('#collapseBtn').click(function () {
            $('.job-post-sidebar').show();
        });
    }
});
document.addEventListener('livewire:load', function () {
    window.livewire.hook('message.processed', () => {
        $(window).scrollTop(0);
        $(document).on('click', '#jobsSearchResults ul li', function () {
            $('#searchByLocation').val($(this).text());
            $('#jobsSearchResults').fadeOut();
        });
    });
});
