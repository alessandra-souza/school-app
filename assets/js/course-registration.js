
 function displayList(name)
{
    jQuery.ajax({
        url: "/api/"+name+"/list",
        type: "Get",
        dataType: 'json',
        error: function(a, b, c) 
            {
                console.log('Error while getting form: ' + b);
            },
        success: function(response) 
            {
                 populate_list(response.data,name);     
            }
        });
}

function   populate_list( data,tbname )
{
   var sel = document.getElementById(tbname+'id');

    for (var i in data) 
    {
        var opt = document.createElement('option');
            if(tbname==='student')
            {
                opt.innerHTML = data[i].first_name;
                
            }
            if(tbname==='course')
            {
                opt.innerHTML = data[i].name;
            }
        opt.value = data[i].id;
        sel.appendChild(opt);
    }    
}

 function postCourseRegestation(formElement)
{
    var statusMessageContainer = $('#status-message');
    
    formElement.submit(function(evt)
    {
        var thisForm = $(this);
        var data = thisForm.serialize();
        jQuery.ajax
        ({
            
            url         : '/api/course/addstudent',
            type        : 'POST', 
            data        : $(this).serialize(), 
            dataType    : 'json', 
            encode      : true,
            error: function(a, b, c) 
            {
                console.log('Error while submitting form: ' + b);
                statusMessageContainer.html(alertBox('danger', 'Error occured while trying to subscribe. Please try again later'));
            },
            success: function(response) 
            {
     
                // reset form
                thisForm[0].reset();
                // display output
                if (response.error)
                {
                    
                    statusMessageContainer.html(alertBox('danger', response.message));
                }
                else if (response.success)
                {
                    statusMessageContainer.html(alertBox('success', response.message));
                    console.log(response.data);
                }
                
                statusMessageContainer.find('.alert').alert();
            }
        });
        evt.preventDefault();
        return false;
    });
}


function alertBox(type, message) {
    var html = [];
    html.push('<div class="alert alert-' + (type || 'info') + ' alert-dismissible fade show" role="alert">');
    html.push('<button type="button" class="close" data-dismiss="alert" aria-label="Close">');
    html.push('<span aria-hidden="true">&times;</span>');
    html.push('</button>');
    html.push('<div class="message">' + message + '</div>');
    html.push('</div>');
    return html.join('');
}

/**
 * After HTML Document loaded
 */
$(document).ready(function () {

 var formElement = $('#course-reg-form');

    if (formElement.length)
    {
        // Triger  form submission handler
        postCourseRegestation(formElement);
    }
 
    displayList('student');
    displayList('course');



});