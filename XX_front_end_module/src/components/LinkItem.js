Vue.component('link-item', {
    // language=HTML
    template: `
        <path :class="cl" :d="d" @click="selectLink"></path>
    `,
    props: ['link'],
    computed: {
        d() {
            let {x:x1, y:y1} = this.link.from.element;
            let {x:x2, y:y2} = this.link.to.element;

            const fromNodeId = this.link.from.node.id;
            const toNodeId = this.link.to.node.id;

            x1 += POSITION[fromNodeId].x / 3;
            y1 += POSITION[fromNodeId].y / 3;
            x2 += POSITION[toNodeId].x / 3;
            y2 += POSITION[toNodeId].y / 3;

            return `M ${x1} ${y1} L ${x2} ${y2}`;
        },
        cl() {
            const arr = ['link'];

            if (this.link.selected) {
                arr.push('selected');
            }

            return arr;
        }
    },
    methods: {
        selectLink() {
            Bus.$emit('select', this.link);
        }
    }
});