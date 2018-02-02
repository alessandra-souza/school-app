
 function searchByCourse(formElement)
{  
    formElement.submit(function(evt)
    {
        var thisForm = $(this);
        var data = thisForm.serialize();
        jQuery.ajax
        ({
             
            url         : '/api/student/bycourse',
            type        : 'POST', 
            data        : $(this).serialize(), 
            dataType    : 'json', 
            encode      : true,
            error: function(a, b, c) 
            {
                console.log('Error while submitting form: ' + b);
            
            },
            success: function(response) 
            {
               
                // reset form
                thisForm[0].reset();
                // display output
                if (response.error)
                {
                    
                    console.log(response.error);
                }
                else if (response.success)
                {
                    displayArray(response.data); 
                    console.log(response.data);
                }
                
              
            }
        });
        evt.preventDefault();
        return false;
    });
}

/**
 * After HTML Document loaded
 */
function displayArray(data) {
    /*
    var tmpl = Handlebars.compile($("#trlist-template").html());
    $('#trlist').html(tmpl({ list: data }));
    */
    var text = "";
    if(data.length>0)
    {
        for (var i in data) 
        {
            text += "<tr>";
            text += "<td>"+data[i].id+' & '+ data.length+" of students</td>";
            text += "<td>"+data[i].first_name+"</td>";
            text += "<td>"+data[i].last_name+"</td>";
            text += "<td>"+data[i].dob+"</td>";
            
            text += "</tr>";
        }
    }
    else
    {
        text +="<tr><td colspan="+4+">No data</td></tr>";
    }

    document.getElementById("trlist").innerHTML = text;
    
}

/**
 * After HTML Document loaded
 */
$(document).ready(function () {

 var formElement = $('#studentbycourse-form');

    if (formElement.length)
    {
        // Triger  form submission handler
        searchByCourse(formElement);
    }
  
});