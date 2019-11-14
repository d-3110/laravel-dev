<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        {{ name }}
                        {{ gender }}
                        {{ birthday }}
                        {{ favorite_food }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        // bladeからデータを受け取り
        props:["profile"],
        data() {
            return {
                name: this.profile.name,
                gender: this.profile.gender,
                birthday: this.profile.gender,
                favorite_food: this.profile.favorite_food,
                hated_food: this.profile.hated_food,
                //postで送信するためのリクエストデータ初期化 編集で使う
                request:{
                    name:''
                }
            }
        },
        methods: {
            // 編集処理
            edit(){
                // リクエストデータに入力値を代入
                this.request.name = this.name;

                // userのidを指定してpatchで送信(patchも出来るようです)
                axios.patch('api/profile/' + this.user.id, this.request).then(res => {
                    console.log(res.data);
                });
            }
        }
    }
</script>
