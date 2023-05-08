<script setup>

import { router } from '@inertiajs/vue3';

defineProps({
     customers:Object
})
function destroy(customer){
    var sure = confirm(`Are you sure ${customer.name}? `)
    if(sure){
        router.delete('/customers/'+id)
    }
}

function edit(id){
    router.get('/customers/'+id+'/edit')
}
 </script>

<template>
    <br><br>
    <div v-if="$page.props.flash.message" class="alert alert-success">
        {{   $page.props.flash.message }}
    </div>
   <div class="card col-5 offset-3">
    <br>
      <br>
    <table class="class table bordered table-hover table-sm">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="customer in customers">
                <td>{{ customer.name }}</td>
                <td>
                    <button class="btn btn-outline-info">View</button>
                    <button @click.prevent="edit(customer.id)" class="btn btn-outline-primary">Edit</button>
                    <button @click.prevent="destroy(customer)"  class="btn btn-outline-danger">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
   </div>
</template>
