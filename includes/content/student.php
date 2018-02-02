<h3>List of Students</h3>
<div class="loader-container">
  <div class="loader"></div>
</div>

<table class="table table-bordered" >
    <thead>
        <tr class="table-success">
          <th>ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Date of birth</th>
      </tr>
 <tbody id='trlist'></tbody>
</table>
<!--pagination-->
<div class="pagination"></div>
<!--pagination-->
<br/>

<script id="trlist-template" type="text/x-handlebars-template">

  {{#if list}}
    {{#each list}}
  <tr class="table-secondary">
     <td>{{id}}</td>
    <td>{{first_name}}</td>
    <td>{{last_name}}</td>
    <td>{{dob}}</td>
  </tr>
    {{/each}}
  {{else}}
  <tr>
    <td colspan="3">No data</td>
  </tr>
  {{/if}}
</script>
<br>

<!-- <form id="student-form" action="/api/student/add" method="post"> -->
  <form id="student-form" >
    <h3>Add Student</h3>
    <div id="status-message" ></div>
    <div class="form-group">
        <label for="first_name">First name</label>
        <input type="text" data-validation="length alphanumeric" data-validation-length="min4" class="form-control" name="first_name" id="first_name" aria-describedby="first_nameHelp" placeholder="First name">
        <small id="first_nameHelp" class="form-text text-muted">First name.</small>
    </div>
    <div class="form-group">
        <label for="last_name">Last name</label>
        <input type="text" data-validation="length" data-validation-length="4-25" class="form-control" name="last_name" id="last_name" aria-describedby="last_nameHelp" placeholder="Last name">
        <small id="last_nameHelp" class="form-text text-muted">Last name.</small>
    </div>
    <div class="form-group">
        <label for="dob">DoB</label>
        <input yyyypmm"dd" data-validation="date" data-validation-format="yyyy-mm-dd" class="form-control" name="dob" id="dob" aria-describedby="dobHelp" placeholder="yyyy-mm-dd">
        <small id="dobHelp" class="form-text text-muted">Date of birth.</small>
    </div>
    <button type="submit" class="btn btn-lg btn-primary" id="btn-add-student">Add</button><br><br><br><br><br>
</form>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="/assets/bootstrap/js/bootpag.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script src="/assets/js/students.js"></script>


<script>
  $.validate({
    lang: 'en'
  });
</script>