Vue.component('edit-mode', {
    // language=HTML
    template: `
        <div id="edit">
            <!-- logo -->
            <img class="logo" src="assets/images/knowledge explorer.png" alt="knowledge explorer">
            <!-- links -->
            <link-group>
                <link-item v-for="link in links" :key="link.key" :link="link"></link-item>
            </link-group>
            <!-- elements -->
            <element-group>
                <element-item v-for="element in elements" :key="element.key":element="element"></element-item>
            </element-group>
            <!-- linking -->
            <div class="linking" v-if="linking" :style="linkingStyle">{{linking.node.id}}</div>
            <!-- editor -->
            <editor-item v-if="selectedElement" :element="selectedElement"></editor-item>
            <!-- nav -->
            <div class="nav">
                <button class="btn btn-info" @click="clear">Clear</button>
                <button class="btn btn-warning" @click="viewMode">View Mode</button>
            </div>
        </div>
    `,
    props: ['elements', 'links'],
    data() {
        return {
            linking : null,
        };
    },
    computed: {
        selectedElement() {
            return this.elements.find(el => el.selected);
        },
        linkingStyle() {
            const {x,y} = this.linking;
            return {
                left: `${x}px`,
                top: `${y}px`,
            }
        }
    },
    methods: {
        keydown(e) {
            if (e.key === 'Backspace' || e.key === 'Delete') {
                e.preventDefault();
                const selectedLink = this.links.find(x => x.selected);
                Bus.$emit('removeLink', selectedLink);
            }
        },

        /* linking */
        linkingStart(element, node) {
            if (node.linkId) return;
            this.linking = {
                x: event.pageX,
                y: event.pageY,
                element, node,
            };
            document.addEventListener('mousemove', this.linkingMove);
            document.addEventListener('mouseup', this.linkingEnd);
        },
        linkingMove({pageX, pageY}) {
            if (!this.linking) return;

            this.linking.x = pageX;
            this.linking.y = pageY;
        },
        linkingDone(element, node) {
            if (node.linkId || !this.linking || this.linking.element === element) return;

            Bus.$emit(
                'linkRelation',
                this.linking.element,
                this.linking.node,
                element,
                node
            );
        },
        linkingEnd() {
            if (!this.linking) return;
            this.linking = null;
            document.removeEventListener('mousemove', this.linkingMove);
            document.removeEventListener('mouseup', this.linkingEnd);
        },

        clear() {
            Bus.$emit('clear');
        },
        viewMode() {
            Bus.$emit('viewMode');
        }
    },
    created() {
        Bus.$on('linkingStart', this.linkingStart);
        Bus.$on('linkingDone', this.linkingDone);
    },
    mounted() {
        document.addEventListener('keydown', this.keydown);
    },
    destroyed() {
        document.removeEventListener('keydown', this.keydown);
    }
});