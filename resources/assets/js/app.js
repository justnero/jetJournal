require('./bootstrap');

var route = Laravel.route;

if (route == 'group.create') {
    group_create();
} else if (route == 'class.show') {
    class_show();
} else if (route == 'class.create') {
    class_create();
}

function group_create() {
    var f_super = $('#group-create-super'),
        f_university = $('#group-create-university'),
        f_institute = $('#group-create-institute'),
        f_cathedra = $('#group-create-cathedra');
    addPlaceholder(f_super, 'Выберите родительскую группу');
    f_university.parent().slideUp();
    f_institute.parent().slideUp();
    f_cathedra.parent().slideUp();
    f_super.on('change', function () {
        var val = f_super.val();
        if (val != 0) {
            f_university.prop('disabled', true);
            f_institute.prop('disabled', true);
            f_cathedra.prop('disabled', true);
            f_university.val('');
            f_institute.val('');
            f_cathedra.val('');
            f_university.parent().slideDown();
            f_institute.parent().slideDown();
            f_cathedra.parent().slideDown();

            loadUIC(val);
        } else {
            f_university.prop('disabled', false);
            f_institute.prop('disabled', true);
            f_cathedra.prop('disabled', true);
            f_university.parent().slideDown();
            f_institute.parent().slideUp();
            f_cathedra.parent().slideUp();
            clearU();
            clearI();
            clearC();
        }
    });
    f_university.on('change', function () {
        var val = f_university.val();
        if (val != 0) {
            f_institute.prop('disabled', false);
            f_cathedra.prop('disabled', true);
            f_institute.parent().slideDown();
            f_cathedra.parent().slideUp();
            loadI(val);
        } else {
            f_institute.prop('disabled', true);
            f_cathedra.prop('disabled', true);
            f_institute.parent().slideUp();
            f_cathedra.parent().slideUp();
            clearI();
            clearC();
        }
    });
    f_institute.on('change', function () {
        var val = f_institute.val();
        if (val != 0) {
            f_cathedra.prop('disabled', false);
            f_cathedra.parent().slideDown();
            loadC(val);
        } else {
            f_cathedra.prop('disabled', true)
            f_cathedra.parent().slideUp();
            clearC();
        }
    });

    function loadUIC(super_id) {
        clearU();
        clearI();
        clearC();
        $.ajax({
            url: window.location,
            data: {
                super_id: super_id
            }
        }).done(function (data) {
            f_university.val(data.university_id);
            addPlaceholder(f_institute, data.institute);
            addPlaceholder(f_cathedra, data.cathedra);
        });
    }

    function loadI(university_id) {
        clearI();
        clearC();
        $.ajax({
            url: window.location,
            data: {
                university_id: university_id
            }
        }).done(function (data) {
            $.each(data, function (key, value) {
                f_institute.append($('<option></option>')
                    .attr('value', key)
                    .text(value));
                addPlaceholder(f_institute, 'Выберите институт');
            });
        });
    }

    function loadC(institute_id) {
        clearC();
        $.ajax({
            url: window.location,
            data: {
                institute_id: institute_id
            }
        }).done(function (data) {
            $.each(data, function (key, value) {
                f_cathedra.append($('<option></option>')
                    .attr('value', key)
                    .text(value));
            });
            addPlaceholder(f_cathedra, 'Выберите кафедру');
        });
    }

    function clearU() {
        f_university.find('option[value=""]').prop('disabled', true).prop('selected', true);
        f_university.val('');
    }

    function clearI() {
        f_institute.find('option').remove();
    }

    function clearC() {
        f_cathedra.find('option').remove();
    }

    function addPlaceholder(el, text) {
        var placeholder = $('<option></option>')
            .prop('disabled', true)
            .prop('selected', true)
            .attr('value', '')
            .text(text);
        el.prepend(placeholder);
        el.val('');
    }
}

function class_show() {
    var checkboxes = $('.presence');
    checkboxes.on('change', function() {
        var $this= $(this);
        var student = $this.closest('.student');
        if($this.is(':checked')) {
            student.addClass('present');
        } else {
            student.removeClass('present');
        }
    });
}
function class_create() {
    var repeat = $('#repeat').find('> select');
    var repeat_till = $('#repeat_till');
    if(repeat.val() == 0) {
        repeat_till.slideUp();
    }
    repeat.on('change', function() {
        if(repeat.val() != 0) {
            repeat_till.slideDown();
        } else {
            repeat_till.slideUp();
        }
    });
}