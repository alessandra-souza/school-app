<h3>Students by course</h3>
<form class="form-inline" id="studentbycourse-form"  >
    <div class="row">
        <div class="form-group mx-sm-3 mb-2">
            <label for="code" class="sr-only">Course code</label>
            <input type="text" class="form-control" name="code" id="code" placeholder="Course code">
        </div>
    </div>
    <button id="btnSub"  type="submit" class="btn btn-primary mb-2">Go</button>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Code & # of students</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Date of birth</th>
        </tr>
    <tbody id='trlist'></tbody>
</table>
<br/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootpag/1.0.7/jquery.bootpag.min.js"></script>
<script src="/assets/js/students_course.js"></script>