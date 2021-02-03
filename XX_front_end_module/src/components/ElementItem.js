Vue.component('element-item', {
    // language=HTML
    template: `
        <div :class="cl" :style="style" @mousedown="dragStart">
            <div class="nodes">
                <button class="node" v-for="node in element.nodes" :class="'node-'+node.id" :key="node.id"
                    @click="createRelation(node)" @mousedown.shift.stop="linkingStart(node)" 
                    @mouseup="linkingDone(node)">
                    <span>{{node.id}}</span>
                </button>
            </div>
            <div class="tools">
                <button class="btn tool btn-primary" @click="editElement">Edit</button>
                <button class="btn tool btn-danger" @click="deleteElement" v-if="element.id != 'root'">Delete</button>
            </div>
        </div>
    `,
    props: ['element'],
    data() {
        return {
            move: 0,
            drag: false,
            temp: {x:0,y:0},
        }
    },
    computed: {
        style() {
            const {x,y} = this.element;
            return {
                left: `${x}px`,
                top: `${y}px`
            }
        },
        cl() {
            const arr = ['element'];

            if (this.element.selected) {
                arr.push('selected');
            }

            if (this.$root.mode === 'view') {
                if (this.element === this.$parent.$parent.$parent.element) {
                    arr.push('viewed');
                }
            }

            return arr;
        }
    },
    methods: {
        createRelation(node) {
            if (this.move > 3) return;

            Bus.$emit('createRelation', this.element, node);
        },
        editElement() {
            if (this.move > 3) return;

            Bus.$emit('select', this.element);
        },
        deleteElement() {
            if (this.move > 3) return;

            Bus.$emit('removeElement', this.element);
        },

        /* drag */
        dragStart({pageX, pageY}) {
            this.move = 0;
            this.drag = true;
            this.temp.x = pageX;
            this.temp.y = pageY;

            document.addEventListener('mousemove', this.dragMove);
            document.addEventListener('mouseup', this.dragEnd);
        },
        dragMove({pageX, pageY}) {
            if (!this.drag) return;
            this.move++;

            const moveX = pageX - this.temp.x;
            const moveY = pageY - this.temp.y;

            this.element.x += moveX;
            this.element.y += moveY;

            this.temp.x = pageX;
            this.temp.y = pageY;
        },
        dragEnd() {
            if (!this.drag) return;

            this.drag = false;
            document.removeEventListener('mousemove', this.dragMove);
            document.removeEventListener('mouseup', this.dragEnd);
        },

        /* linking */
        linkingStart(node) {
            Bus.$emit('linkingStart', this.element, node);
        },
        linkingDone(node) {
            Bus.$emit('linkingDone', this.element, node);
        }
    }
});