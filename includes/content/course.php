<h3>List of Courses</h3>
<div class="loader-container">
  <div class="loader"></div>
</div>

<table class="table table-bordered" id="table-courses">
    <thead>
        <tr class="table-success">
            <th>Code</th>
            <th>Name</th>
            <th>Description</th>
            <th># of students</th>
       </tr>
 <tbody id='trlist'></tbody>
</table>
<!--pagination-->
<div class="pagination"></div>
<!--pagination-->

<script id="trlist-template" type="text/x-handlebars-template">
  {{#if list}}
    {{#each list}}
  <tr class="table-secondary">
    <td>{{code}}</td>
    <td>{{name}}</td>
    <td>{{description}}</td>
    <td>{{totalNumberStudents}}</td>
  </tr>
    {{/each}}
  {{else}}
  <tr>
    <td colspan="4">No data</td>
  </tr>
  {{/if}}
</script>
<br><br>

<!-- <form id="course-form" action="/api/course/add" method="post"> -->
  <form id="course-form" >
    <h3>Add Course</h3>
    <div id="status-message" ></div>
    <div class="form-group">
        <label for="code">Code</label>
        <input data-validation="length alphanumeric" data-validation-length="min4" type="text" class="form-control" name="code" id="code" aria-describedby="codeHelp" placeholder="Course code">
        <small id="codeHelp" class="form-text text-muted">Course code.</small>
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input data-validation="length" data-validation-length="4-25" type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp" placeholder="Course name">
        <small id="nameHelp" class="form-text text-muted">Course name.</small>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <span id="max-length-element">50</span> chars left
        <textarea data-validation="length" data-validation-length="min10" class="form-control" name="description" id="description" aria-describedby="descriptionHelp" placeholder="Course description"></textarea>
        <small id="descriptionHelp" class="form-text text-muted">Course description.</small>
    </div>
    <button type="submit" class="btn btn-lg btn-primary" id="btn-add-course">Add</button><br><br><br><br><br>
</form>
<br><br><br>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootpag/1.0.7/jquery.bootpag.min.js"></script>
  <script src="/assets/js/courses.js"></script>
  
  <script>
  $.validate({
    lang: 'en'
  });
  $('#description').restrictLength( $('#max-length-element') );
</script>
      