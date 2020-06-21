async function clearForm(formId) {
    $(formId + ' input:not(#user_id), ' + formId + ' select').val('').trigger('change');
    $(formId + ' #type-request').val('new').trigger('change');
}

async function editData(el) {
    try {
        let element = $(el);
        let url = show_path.replace('#UUID#', element.data().uuid);
        let response = await getData(url);
        fillItem(response);
        return;
    } catch (error) {
        console.error(error);
    }
}

async function deleteData(el) {
    try {
        let element = $(el);
        let url = show_path.replace('#UUID#', element.data().uuid);
        await sendItem(url, {}, 'DELETE');
        return;
    } catch (error) {
        console.error(error);
    }
}

async function getData(url) {
    try {
        let response = await fetch(url, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            }
        });
        response = await response.json();
        return await resolveResult(response);
    } catch (error) {
        console.error(error);
    }
}

async function postData(url, dataJson, type = 'POST') {
    try {
        let response = await fetch(url, {
            method: type,
            body: JSON.stringify(dataJson),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            }
        });
        response = await response.json();
        return await resolveResult(response, type == 'DELETE' ? true : false);
    } catch (error) {
        console.error(error);
    }
}

async function resolveResult(response, returnToast = false) {
    if (typeof response.success != 'undefined') {
        if (response.success.status) {
            if (returnToast) {
                addToast('bg-success', 'Sucesso!', ' ', response.success.message);
                return {};
            }
            return response.success.content;
        }
        addToast('bg-danger', 'Error', ' ', response.success.message);
        return {};
    }
    addToast('bg-danger', 'Error', ' ', response.error.message);
    return {};
}
