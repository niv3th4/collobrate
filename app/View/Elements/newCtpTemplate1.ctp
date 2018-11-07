<form class="form-data create-popup">
    <div class="left-pop">
        <label>Name of the classrom</label>
        <input type="text" class="pop-input" />
        <label>University Association</label>
        <select class="chosen-select select_option">
            <option>University Association 1</option>
            <option>University Association 2</option>
            <option>University Association 3</option>
            <option>University Association 4</option>
        </select>
        <label>Department</label>
        <select class="chosen-select select_option">
            <option>Department 1</option>
            <option>Department 2</option>
            <option>Department 3</option>
            <option>Department 4</option>
        </select>
        <label>Year</label>
        <div class="year-dd">
            <select class="chosen-select">
                <option>2010</option>
                <option>2011</option>
                <option>2012</option>
                <option>2013</option>
            </select>
        </div>
    <div class="check-btn">
        <input id="others" type="checkbox" name="others" value="others">
        <label for="others" class="radio-lbl">Others</label>
    </div>
    <label>Duration of the course</label>
    <div class="calender create-date">
        <input type="text" class="pop-dura date_popup" />
    </div>
    <div class="calender create-date">
        <input type="text" class="pop-dura date_popup" />
    </div>
    <label>Semester</label>
    <select class="chosen-select select_option">
        <option>Semester 1</option>
        <option>Semester 2</option>
        <option>Semester 3</option>
        <option>Semester 4</option>
    </select>
</div>
<div class="right-pop">
    <label>Course Type</label>
    <div class="radio-btn">
        <input id="Public" type="radio" name="course" value="Public">
        <label for="Public" class="radio-lbl">Public</label>
        <input id="Private" type="radio" name="course" value="Private">
        <label for="Private" class="radio-lbl">Private</label>
    </div>
    <label>Course Description</label>
    <textarea class="pop-txtarea"></textarea>
    <label>Degree</label>
    <input type="text" class="pop-input" />
    <label>You tube video link</label>
    <input type="text" class="pop-input" />
    <label>Minimum required attendance</label>
    <input type="text" class="pop-dura" pattern="[0-9]{0,3}" title="Should be numbers.Max 3 numbers" />
    % </div>
<div class="clear"></div>
<div class="submit-btn">
    <input type="button" class="sub-btn" value="Create" id="quiz-link">
</div>
</form>

<div class="submit-btn">
    <div class="submit"><input  type="submit" value="Create"/></div></form>                    </div>