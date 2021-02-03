const Bus = new Vue;

const REVERSE = {
    1: 3,
    2: 4,
    3: 1,
    4: 2
};

const POSITION = {
    1: {x:0, y:-150},
    2: {x:150, y:0},
    3: {x:0, y:150},
    4: {x:-150, y:0}
};

const LOCAL_ELEMENTS = '200907_elements';
const LOCAL_LINKS = '200907_links';

const vm = new Vue({
    el: '#app',
    data: {
        mode: 'edit',
        elements: [],
        links: [],
    },
    watch: {
        elements: {
            deep: true,
            handler() {
                localStorage.setItem(LOCAL_ELEMENTS, JSON.stringify(this.elements));
            },
        },
        links: {
            deep: true,
            handler() {
                localStorage.setItem(LOCAL_LINKS, JSON.stringify(this.links.map(link => {
                    return Object.assign({}, link, {
                        from: {
                            element: link.from.element.id,
                            node: link.from.node.id,
                        },
                        to: {
                            element: link.to.element.id,
                            node: link.to.node.id
                        }
                    });
                })));
            }
        },
    },
    methods: {
        /* init */
        init() {
            if (localStorage.getItem(LOCAL_ELEMENTS)) {
                this.restore();
            } else {
                this.clear();
            }
        },
        clear() {
            this.elements = [];
            this.links = [];
            this.createElement({id: 'root'});
        },

        /* restore */
        restore() {
            this.elements = JSON.parse(localStorage.getItem(LOCAL_ELEMENTS));
            this.links = JSON.parse(localStorage.getItem(LOCAL_LINKS)).map(link => {
                const fromEl = this.elements.find(x => x.id === link.from.element);
                const toEl = this.elements.find(x => x.id === link.to.element);

                return Object.assign({}, link, {
                    from: {
                        element:fromEl,
                        node:fromEl.nodes.find(x => x.id === link.from.node)
                    },
                    to: {
                        element:toEl,
                        node:toEl.nodes.find(x => x.id === link.to.node)
                    },
                });
            });
        },

        /* elements */
        createElement(option) {
            const o = {
                id: Date.now(), key: Date.now(),
                x: window.innerWidth / 2,
                y: window.innerHeight / 2,
                title: 'Lorem ipsum dolor sit amet',
                content: `
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At eaque eligendi eos eum eveniet exercitationem facere, laudantium maxime nam nihil, praesentium quaerat sequi sunt! Deserunt eveniet odio praesentium voluptatem voluptatum.</p>
                    <img src="assets/images/example.jpg" alt="museum">
                `,
                selected: false,
                nodes: [
                    {id: 1, caption: '', linkId: null}, {id: 2, caption: '', linkId: null},
                    {id: 3, caption: '', linkId: null}, {id: 4, caption: '', linkId: null},
                ],
            };
            const element = Object.assign({}, o, option);
            this.elements.push(element);
            return element;
        },
        removeElement(element) {
            element.nodes.forEach(no => {
                if (no.linkId) {
                    const link = this.links.find(x => x.id === no.linkId);
                    this.removeLink(link);
                }
            });

            const idx = this.elements.findIndex(el => element === el);
            this.elements.splice(idx, 1);
        },

        /* link */
        createLink(option) {
            const o = {
                id: Date.now(),
                key: Date.now(),
                from: {
                    element:null,
                    node:null,
                },
                to: {
                    element:null,
                    node:null,
                },
                selected: false,
            };

            const link = Object.assign({}, o, option);
            this.links.push(link);
            return link;
        },
        removeLink(link) {
            link.from.node.linkId = null;
            link.to.node.linkId = null;
            const idx = this.links.findIndex(x => x === link);
            this.links.splice(idx, 1);
        },

        /* relation */
        createRelation(element, node) {
            if (node.linkId) return;

            const newElement = this.createElement({
                x: element.x + POSITION[node.id].x,
                y: element.y + POSITION[node.id].y
            });

            const newNode = newElement.nodes.find(x => x.id === REVERSE[node.id]);

            this.linkRelation(element, node, newElement, newNode);
        },
        linkRelation(el1, no1, el2, no2) {
            const link = this.createLink();

            link.from.element = el1;
            link.from.node = no1;
            link.to.element = el2;
            link.to.node = no2;

            no1.linkId = link.id;
            no2.linkId = link.id;
        },

        /* select */
        deselect() {
            this.elements.forEach(element => element.selected = false);
            this.links.forEach(element => element.selected = false);
        },
        select (item) {
            this.deselect();
            item.selected = true;
        },

        /* mode */
        viewMode() {
            this.mode = 'view';
            this.deselect();
        },
        editMode() {
            this.mode = 'edit';
        }
    },
    created() {
        this.init();

        Bus.$on('createRelation', this.createRelation);
        Bus.$on('linkRelation', this.linkRelation);

        Bus.$on('deselect', this.deselect);
        Bus.$on('select', this.select);

        Bus.$on('removeElement', this.removeElement);
        Bus.$on('removeLink', this.removeLink);

        Bus.$on('clear', this.clear);
        Bus.$on('viewMode', this.viewMode);
        Bus.$on('editMode', this.editMode);
    }
});