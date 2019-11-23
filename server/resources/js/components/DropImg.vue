<template>
    <div class="modal fade" id="img_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="drop_area" :class="[{'-drag': isDrag == 'new'}]"
                @dragover.prevent="checkDrag($event, 'new', true)"
                @dragleave.prevent="checkDrag($event, 'new', false)"
                @drop.prevent="fileSelected"
                >
                    <div class="drop">
                        <p class="drag-drop-info">ここにファイルをドロップ</p>
                        <p>または</p>
                        <label for="corporation_file" class="btn btn-dark">
                            ファイルを選択
                        <input type="file" class="drop__input" style="display:none;"
                        id="corporation_file"
                        @change="fileSelected"
                        >
                        </label>
                    </div>
                    <div class="drop">
                        <img v-if="up" class="card-img-top profile_img" :src="preview_img" alt="preview" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    <button type="button"
                            class="btn btn-primary"
                            data-dismiss="modal"
                            @click="fileUpload"
                            :disabled="!up"
                    >
                    OK
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['user_id'],
    data() {
        return {
            isDrag: null,
            img_file: '',　// 画像ファイル
            file_path: '', // 画像ファイルパス
            preview_img:'',
            up: false,

        }
    },
    methods: {
        checkDrag(event, key, status){
            if (status && event.dataTransfer.types == "text/plain") {
                //ファイルではなく、html要素をドラッグしてきた時は処理を中止
                return false
            }
            this.isDrag = status ? key : null
        },

        // 画像選択
        fileSelected(e){
          let files = e.target.files || e.dataTransfer.files
          this.previewImage(files[0])
          this.img_file = files[0]
        },

        // プレビュー表示
        previewImage(file) {
          const reader = new FileReader()
          reader.onload = e => {
            this.preview_img = e.target.result
          };
          reader.readAsDataURL(file)
          this.up = true
        },

        // ファイルアップロード
        fileUpload(){
            const formData = new FormData()
            formData.append('file',this.img_file)
            axios.post('/api/profiles/fileupload/' + this.user_id, formData).then(response =>{
                
                // 親コンポーネントの画像を変更
                // トリガを設定
                this.file_path = 
                '/storage/profiles/' + this.user_id + '/' +this.img_file.name
                this.$emit('update_img_file', this.file_path)

            });
        }
    }
}
</script>