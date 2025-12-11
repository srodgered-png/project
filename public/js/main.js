document.addEventListener('DOMContentLoaded', async function () {
    await gatUserList();
});

async function gatUserList() {
    let data = await getUsers();

    const table = document.getElementById('table_user_list');
    const tbody = table.querySelector('tbody');
    tbody.innerHTML = "";

    data.forEach(item => {
        const tr = document.createElement('tr');

        tr.innerHTML = `
            <td>${item.id}</td>
            <td>${item.first_name}</td>
            <td>${item.last_name}</td>
            <td>${item.position.name}</td>
            <td>
                <button type="button" onclick="getUserToForm(${item.id})" class="btn btn-sm btn-warning">Update</button>
                <button type="button" onclick="deleteEvnUser(${item.id})" class="btn btn-sm btn-danger">Delete</button>
            </td>
        `;

        tbody.appendChild(tr);
    });
}

document.getElementById("clear_form").addEventListener("click", async function (e) {
    e.preventDefault();

    let form = document.getElementById('edit_form');
    form.querySelector('input[name="id"]').value        = '';
    form.querySelector('input[name="first_name"]').value     = '';
    form.querySelector('input[name="last_name"]').value     = '';
    form.querySelector('select[name="position"]').value = '';

});

document.getElementById("edit_form").addEventListener("submit", async function (e) {
    e.preventDefault();

    let form = document.getElementById('edit_form');

    let id = form.querySelector('input[name="id"]').value;
    if (id) {
        let data = await updateUser({
            'id':       id,
            'first_name':    form.querySelector('input[name="first_name"]').value,
            'last_name':    form.querySelector('input[name="last_name"]').value,
            'position': form.querySelector('select[name="position"]').value
        });

        if (data && data.error) {
            alert(data.error);
            return;
        }

        if (data && data.errors) {
            let form_errors = document.getElementById('form_errors');
            form_errors.innerHTML = '';
            data.errors.forEach(item => {
                const div = document.createElement('div');

                div.innerHTML = item;
                form_errors.appendChild(div);
            });
        }

    } else {
        let data = await createUser({
            'first_name': form.querySelector('input[name="first_name"]').value,
            'last_name':  form.querySelector('input[name="last_name"]').value,
            'position':   form.querySelector('select[name="position"]').value
        });

        if (data && data.error) {
            alert(data.error);
            return;
        }

        if (data && data.errors) {
            let form_errors = document.getElementById('form_errors');
            form_errors.innerHTML = '';
            data.errors.forEach(item => {
                const div = document.createElement('div');
                div.innerHTML = item;
                form_errors.appendChild(div);
            });
        }
    }

    await gatUserList();
});

async function getUserToForm(id) {
    let data = await getUser(id);

    let form = document.getElementById('edit_form');

    form.querySelector('input[name="id"]').value         = data.id;
    form.querySelector('input[name="first_name"]').value = data.first_name;
    form.querySelector('input[name="last_name"]').value  = data.last_name;
    form.querySelector('select[name="position"]').value  = data.id_position;
}

async function deleteEvnUser(id) {
    await deleteUser(id);
    await gatUserList();
}
