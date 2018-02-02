/**
 * JS function for handling form submission
 * 
 * @param {type} formElement
 * @returns {undefined}
 */



function getDataCourses() {
    jQuery.ajax({
        url: "/api/course/list",
        type: "Get",
        dataType: 'json',
        error: function (a, b, c) {
            console.log('Error while getting form: ' + b);
        },
        success: function (response) {

            $('.loader').hide();

            displayArray(response.data)
            display(response.data);

        }
    });
}

/**
 * After HTML Document loaded
 */
///-------------------------------
function display(data) {
    var pageSize = 5;
    var totalPage = Math.ceil(data.length / pageSize);
    $(".pagination").bootpag({
        total: totalPage,
        page: 1,
        maxVisible: 20
    }).on("page", function (e, page_num) {
        //e.preventDefault();
        displayArray(data, page_num - 1);
    });


}
function displayArray(data, pNum = 0) {
    var totalRow = 5;
    totalPage = data.length;

    var newArr = data.slice((pNum * totalRow), ((pNum * totalRow) + totalRow));

    var tmpl = Handlebars.compile($("#trlist-template").html());
    $('#trlist').html(tmpl({ list: newArr }));

}


function postDataCourse(formElement) {
    var statusMessageContainer = $('#status-message');

    formElement.submit(function (evt) {
        var thisForm = $(this);
        var data = thisForm.serialize();
        jQuery.ajax
            ({
              
                url: '/api/course/add',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                encode: true,
                error: function (a, b, c) {
                    console.log('Error while submitting form: ' + b);
                    statusMessageContainer.html(alertBox('danger', 'Error occured while trying to subscribe. Please try again later'));
                },
                success: function (response) {
                    // populate table
                    $('#btn-add-course').click(getDataCourses());
                    // reset form
                    thisForm[0].reset();

                    // display output
                    if (response.error) {

                        statusMessageContainer.html(alertBox('danger', response.error));
                    }
                    else if (response.success) {
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


/**
 * 
 * JS function for wrapping alert message
 * 
 * @param {String} type
 * @param {String} message
 * @returns {String}
 */
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

    var formElement = $('#course-form');

    if (formElement.length) {
        // Triger  form submission handler
        postDataCourse(formElement);
    }

    setTimeout(getDataCourses, 500);

});