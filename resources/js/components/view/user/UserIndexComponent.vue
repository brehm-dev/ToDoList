<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($users as $user)
                <div class="card">
                    <div class="card-header">id</div>

                    <div class="card-body">
                        <h5 class="card-title">names</h5>
                        <p class="card-text">data</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserIndexComponent"
    }
</script>

<style scoped>

</style>
