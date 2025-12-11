async function getUsers() {
    let response = await fetch('/v1/api/users/all', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        }
    });

    if (!response.ok) {
        console.error('API request failed:', response.status);
        alert('API request failed');
        return;
    }

    return await response.json();
}

async function getUser(id) {
    let response = await fetch('/v1/api/users?id='+id, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        }
    });

    if (!response.ok) {
        console.error('API request failed:', response.status);
        alert('API request failed');
        return;
    }

    return await response.json();
}

async function createUser(data) {
    let response = await fetch('/v1/api/users', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });

    if (!response.ok) {
        console.error('API request failed:', response.status);
        alert('API request failed');
        return;
    }

    return await response.json();
}

async function updateUser(data) {
    let response = await fetch('/v1/api/users', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });

    if (!response.ok) {
        console.error('API request failed:', response.status);
        alert('API request failed');
        return;
    }

    return await response.json();
}

async function deleteUser(id) {
    await fetch('/v1/api/users', {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json'
        },
        body: JSON.stringify({'id': parseInt(id)})
    });
}