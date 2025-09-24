$(document).ready(function () {
    // Add skill field
    $('#addSkillBtn').click(function () {
        $('#skillsWrapper').append(`
            <div class="d-flex mb-2 skill-item">
                <input type="text" name="skills[]" class="form-control" placeholder="e.g. React, MySQL">
                <button type="button" class="btn btn-danger ms-2 remove-skill">X</button>
            </div>
        `);
    });

    // Remove skill field
    $(document).on('click', '.remove-skill', function () {
        $(this).closest('.skill-item').remove();
    });
});
