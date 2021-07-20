import axios from "axios"

export async function readAll() {
    return axios.get(`http://localhost:8001/api/order`)
        .then(res => {
            return res.data
        })
}


export async function create(form) {
    return axios.post(`http://localhost:8001/api/order`, form)
        .then(res => {
            return res.data
        })

}

export async function show(id) {
    return axios.get(`http://localhost:8001/api/order/${id}`)
        .then(res => {
            return res.data
        })

}

export async function update(id, form) {
    return axios.put(`http://localhost:8001/api/order/${id}`, form)
        .then(res => {
            return res.data
        })

}

export async function destroy(id) {
    return axios.delete(`http://localhost:8001/api/order/${id}`)
        .then(res => {
            return res.data
        })

}

export async function destroyAll(ids) {
    return axios.delete(`http://localhost:8001/api/order`, {
        data: {
            ids: ids
        }
    })
        .then(res => {
            return res.data
        })

}