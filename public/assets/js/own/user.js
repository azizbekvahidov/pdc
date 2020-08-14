function createSelect() {
    var select          = document.createElement('select'),
        option          = document.createElement("option"),
        optionAdmin     = document.createElement("option"),
        optionTeacher   = document.createElement("option"),
        optionStudent   = document.createElement("option"),
        btn             = document.createElement('btn');
        // clicked         = false;
    select.name             = 'role_id';
    option.value            = "";
    option.innerText        = "Выберите";
    select.append(option);
    optionAdmin.value       = '1';
    optionAdmin.innerText   = "Админ";
    select.append(optionAdmin);
    optionTeacher.value     = '2';
    optionTeacher.innerText = "Учитель";
    select.append(optionTeacher);
    optionStudent.value     = '3';
    optionStudent.innerText = "Студент";
    select.append(optionStudent);
    btn.className           = "btn btn-success";
    btn.id                  = "send";
    btn.innerText           = "Изменить";
    let temp = {
                "select":       select,
                "btn":          btn,
                "tempParent":   null,
                "tempElement":  null,
                "clicked":      false};
    return temp;
}

$(document).on('click','#change',function () {
    let selectedCreate = createSelect(),
        parent = $(this).parent(),
        elements = parent.html();
    if(selectedCreate.clicked){
        selectedCreate.tempParent.html(selectedCreate.tempElement);
    }
    $(this).remove();
    parent.html(selectedCreate.select);
    selectedCreate.select.after(selectedCreate.btn);
    // selectedCreate.clicked = true;
    // selectedCreate.tempParent  = parent;
    // selectedCreate.tempElement = elements;
});


function sendAjax(id, url, token, parent) {
    var data = {
        '_token':       token,
        'role_id':      $('select').val(),
        'id':           id,
    };
    $.ajax({
        url: url,
        type: 'post',
        data: data,
        success: function (response) {
            let color = null;

            if (response.id == "Админ"){
                color = "btn-success";
            }
            else if(response.id == "Учитель"){
                color = "btn-primary";
            }
            else if(response.id == "Студент"){
                color = "btn-warning";
            }
            parent.html("<button class='btn "+color+"' id='change'>"+response.id+"</button>");
        }
    });
}
function urlChecking(url) {
    console.log("It is in urlChecking function: " + url);
    let errorMessage = "Введите ресурс из mover или youtube";
    if(url.slice(8, 11) == 'www'){
        if(url.slice(12, 17) != 'mover' && url.slice(12,19) != 'youtube'){
            $('button').attr('disabled', 'disabled');
            $('#errorMessage').addClass('errorText');
            $('#errorMessage').text(errorMessage);

        }
        else{
            $('button').removeAttr('disabled');
            $('#errorMessage').text("");
            $('#errorMessage').removeAttr("class");
        }
    }
    else{
        let firstPart   = url.slice(0,8);
        let secondPart  = url.slice(8,url.length);
        url = firstPart + "www." + secondPart;
        urlChecking(url);
    }

    return url;
}
