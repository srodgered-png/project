<html>
    <head>
        <title>Test task</title>
        <link href="/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="mt-5">
                <div id="form_errors" style="color: red"></div>
                <form id="edit_form">
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" aria-describedby="First Name">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" aria-describedby="Last Name">
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <select class="form-select" name="position" id="position" aria-label="Position">
                            <option selected></option>
                            <?php foreach ($positions as $position) : ?>
                                <option value="<?php echo $position->getId(); ?>"><?php echo $position->getName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button id="clear_form" class="btn btn-primary">Clear</button>
                </form>
            </div>

            <table id="table_user_list" class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Position</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <script src="/js/bootstrap.bundle.min.js"></script>
        <script src="/js/rest-api.js"></script>
        <script src="/js/main.js"></script>
    </body>
</html>