window.addEventListener("load", () => {
    let f = new FestivalCS();
});

class FestivalCS {
    constructor() {
        this.datas = datas;
        this.$tbody = $('.festivalCS table tbody');
        this.$btns = $(".festivalCS .pagination_group");
        this.render();
    }

    render() {
        let qs = this.getQueryString();

        let page = qs.page;
        let type = qs.dassdd;
        page = isNaN(page) || !page || page < 1 ? 1 : page;

        const ITEM_COUNT = 11;
        const BTN_COUNT = 5;

        let total_page = Math.ceil(this.datas.length / ITEM_COUNT);
        let currentBlock = Math.ceil(page / BTN_COUNT);

        let start = currentBlock * BTN_COUNT - BTN_COUNT + 1;
        start = start < 1 ? 1 : start;
        let end = start + BTN_COUNT - 1;
        end = end > total_page ? total_page : end;

        let prev = start - 1 > 1;
        let next = end + 1 < total_page;

        let start_idx = (page - 1) * ITEM_COUNT;
        let end_idx = start_idx + ITEM_COUNT;
        let view_list = this.datas.slice(start_idx, end_idx);
        let htmlBtns = `<a href="?page=${start - 1}&searchType=${type}" class="${!prev ? 'disable' : ''}">&lt</a>`;
        for (let i = start; i <= end; i++) {
            htmlBtns += `   <a href="?page=${i}&searchType=${type}" class="${i == page ? 'active' : ''}">${i}</a>`;
        }
        htmlBtns += ` <a href="?page=${end + 1 >= total_page ? total_page : end + 1}&searchType=${type}" class="${!next ? 'disable' : ''}">&gt</a>`;
        this.$btns.html(htmlBtns);

        this.draw(view_list);
    }


    draw(view_list) {
        view_list.forEach(item => {
            this.$tbody.append(this.makeDom(item));
        });


    }

    makeDom(item) {
        return `
                     <tr>
                        <td><a href="/update?idx=${item.idx}" class="black_a">${item.idx}</a></td>
                        <td>
                            <a href="/view?idx=${item.idx}" class="black_a">
                               ${item.name}
                                <span class="tag">${item.img_cnt}</span>
                            </a>
                        </td>
                        <td>
                            <a href="/down?idx=${item.idx}&type=tar" class="btn0 btn1">tar</a>
                            <a href="/down?idx=${item.idx}&type=zip" class="btn0 btn1">zip</a>
                        </td>
                        <td>
                           ${item.date}
                        </td>
                        <td>
                            <span class="tag">
                                ${item.area}
                            </span>
                        </td>
                    </tr>
        `
    }


    getQueryString() {
        return location.search.substr(1).split("&").reduce((obj, item) => {
            let [key, value] = item.split("=");
            obj[key] = value;
            return obj;
        }, {});
    }
}