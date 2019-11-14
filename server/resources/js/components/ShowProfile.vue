<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        {{ user.name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: []
            }
        },
        mounted() {
            var self = this;
            var url = '/api/profiles/1';
            axios.get(url).then(function(res){
                self.user = res.data;
            })
            .catch(function(error) {
                console.log('ERROR!! occurred in Backend.')
            });
        }
    }
</script>
