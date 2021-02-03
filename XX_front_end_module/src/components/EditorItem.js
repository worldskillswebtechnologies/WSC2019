Vue.component('editor-item', {
    // language=HTML
    template: `
        <div class="editor" @keydown.stop>
            <div class="form-group">
                <button class="btn btn-danger" @click="close">Close</button>
            </div>
            <div class="form-group">
                <label for="input-title">Title</label>
                <input type="text" class="form-control" id="input-title" v-model="element.title">
            </div>
            <div class="form-group">
                <span>Content</span>
                <div id="ckeditor"></div>
            </div>
            
            <div class="form-inline mb-2" v-for="node in linkedNodes" :key="node.id">
                <label class="mr-3" :for="'input-'+node.id">Caption {{node.id}}</label>
                <input type="text" class="form-control flex-grow-1" :id="'input-'+node.id" v-model="node.caption">
            </div>
            
        </div>
    `,
    props: ['element'],
    computed: {
        linkedNodes() {
            return this.element.nodes.filter(node => node.linkId);
        }
    },
    methods: {
        close() {
            Bus.$emit('deselect');
        }
    },
    updated() {
        CKEDITOR.instances.ckeditor.setData(this.element.content);
    },
    mounted() {
        CKEDITOR.replace('ckeditor', {
            removePlugins: ['cloudservices', 'easyimage'],
        });

        CKEDITOR.instances.ckeditor.setData(this.element.content);

        CKEDITOR.instances.ckeditor.on('change', () => {
            this.element.content = CKEDITOR.instances.ckeditor.getData();
        });
    }
});