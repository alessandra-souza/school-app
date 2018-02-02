<h3>Course Registration</h3>
 <div id="status-message" ></div>
<form id="course-reg-form">
    <div class="form-group">
        <label for="studentid">Student</label>
        <select class="form-control" name="studentid" id="studentid" aria-describedby="studentidHelp">
            <option  value="">Select student</option>
        </select>
        <small id="studentidHelp" class="form-text text-muted">List of students.</small>
    </div>
    <div class="form-group">
        <label for="courseid">Course</label>
        <select class="form-control" name="courseid" id="courseid" aria-describedby="courseidHelp">
            <option value="">Select course</option>
        </select>
        <small id="courseidHelp" class="form-text text-muted">List of courses.</small>
    </div>
    <button type="submit" class="btn btn-lg btn-primary">Register</button>
</form>
<script src="/assets/js/course-registration.js"></script>