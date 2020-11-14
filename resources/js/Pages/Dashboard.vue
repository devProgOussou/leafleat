<template>
<app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </template>

    <div class="py-12">
        <form @submit.prevent="handleSubmit">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 bg-dark">
                        <p class="text-white m-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis animi quibusdam neque nesciunt necessitatibus culpa natus consequatur sint pariatur? Ullam ab maiores sint tempora, non delectus vitae omnis expedita aspernatur!</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        AppLayout,
    },
}
</script>
