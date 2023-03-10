<template>
    <div>
        <h2>{{ title }} <small>(Qtd de Cadstros = {{ users.length }})</small></h2>
        <table>
            <thead>
                <th>{{ columns[0] }}</th>
                <th>{{ columns[1] }}</th>
                <th>{{ columns[2] }}</th>
                <th>{{ columns[3] }}</th>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td scope="row">{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.username }}</td>
                    <td>{{ user.email }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
export default{
    name: 'UsersListComponent',
    props:{
        users: Array,
        title: String,
        columns: [],
    }
}
</script>