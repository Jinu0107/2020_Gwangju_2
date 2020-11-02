window.addEventListener("load", () => {
    let f = new Festival();
});

class Festival {
    constructor() {
        this.xml;
        this.datas;
        this.$content = $(".j_festival .content");
        this.$btns = $('.j_festival .page_btn_group');
        this.$modal = $('#view_modal');
        this.$modal.dialog({
            'width': 800,
            'my': 'center',
            'at': 'center',
            'show': true,
            'hidden': true,
            'modal': true,
            'autoOpen': false
        });

        this.init();
    }


    async init() {
        this.xml = await this.getXML();
        this.datas = this.getDatas();
        log(this.datas);

        this.render();
        this.setEvent();
    }

    setEvent() {
        this.$content.on("click", "[data-target='.view_modal']", (e) => {
            let id = e.currentTarget.dataset.id;
            let data = this.datas.find(x => x.id == id);
            let imgLen = data.images.length;
            let htmlBtns = ` <button class="btn0 btn2 rel" data-value="-1" disabled>&lt;</button>`;
            for (let i = 1; i <= imgLen; i++) {
                htmlBtns += ` <button class="btn0 ${i == 1 ? 'btn1' : 'btn2'} numBtn" data-value="${i - 1}">${i}</button>`;
            }
            htmlBtns += `<button class="btn0 btn2 rel" data-value="1">&gt;<button>`;
            let htmlImgs = data.images.map(x => `   <img src="${data.image_path}/${x}" class="img_cover"style="width : calc(100% / ${imgLen});" alt="No Image">`);

            this.$modal.data("sno", 0);
            $("#view_modal .inner").html(this.makeModalDom(data));
            $("#view_modal .inner .pagination").html(htmlBtns);
            $("#view_modal .inner .slide_pannel").html(htmlImgs.join(''));
            this.$modal.dialog("open");

        });

        $(document).on("click", ".pagination > button", (e) => {
            let value = e.currentTarget.dataset.value;
            let imgLen = this.$modal.find(".slide_pannel > img").length;
            let cno = this.$modal.data("sno");
            let sno;
            if (e.currentTarget.classList.contains("rel")) {
                sno = cno + (value * 1)
            } else {
                sno = value * 1;
            }

            this.$modal.data("sno", sno);
            this.$modal.find(".slide_pannel").css("left", -100 * sno + "%");
            this.$modal.find(".pagination > .btn1").removeClass("btn1").addClass("btn2");
            this.$modal.find(".pagination > .numBtn").eq(sno).removeClass("btn2").addClass("btn1");
            this.$modal.find(".pagination > .rel").removeAttr("disabled", "disabled");
            if (sno - 1 < 0) {
                this.$modal.find(".pagination > .rel").eq(0).attr("disabled", "disabled");
            } else if (sno + 1 >= imgLen) {
                this.$modal.find(".pagination > .rel").eq(1).attr("disabled", "disabled");
            }
        });
    }

    makeModalDom(data) {
        return `
            <div class="title">${data.nm}</div>
                    <div class="info">
                        <div class="img_box">
                            <img src="${data.image_path}/${data.images[0]}" alt="No Image">
                        </div>
                        <div class="text">
                            <table class="table">
                                <tr>
                                    <th width="30%">지역</th>
                                    <th width="70%" class="area">${data.area}</th>
                                </tr>
                                <tr>
                                    <th width="30%">장소</th>
                                    <th width="70%" class="location">${data.location}</th>
                                </tr>
                                <tr>
                                    <th width="30%">기간</th>
                                    <th width="70%" class="dt">${data.dt}</th>
                                </tr>
                            </table>
                            <p class="cn">
                                ${data.cn}
                            </p>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="slide_pannel" style="width : ${100 * data.images.length}%">
                           
                        </div>
                    </div>
                    <div class="pagination flex_c">
                       
                    </div>
        `
    }


    render() {
        let qs = this.getQueryString();

        let page = qs.page;
        let type = qs.searchType;

        page = isNaN(page) || !page || page < 1 ? 1 : page;
        type = ['album', 'list'].includes(type) ? type : 'album';

        document.querySelectorAll(".festival_btns").forEach(x => {
            if (x.dataset.type == type) {
                x.classList.remove("disable");
            } else {
                x.classList.add("disable");
            }
        });

        const ITEM_COUNT = type == 'album' ? 6 : 10;
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
        htmlBtns += ` <a href="?page=${end + 1}&searchType=${type}" class="${!next ? 'disable' : ''}">&gt</a>`;
        this.$btns.html(htmlBtns);

        if (type == 'album') this.drawAlbum(view_list);
        else this.drawList(view_list);
    }

    drawAlbum(view_list) {
        let main_festival = this.datas[this.datas.length - 1];
        let view_items = view_list.map(x => this.makeAlbumItemDom(x));
        this.$content.html(this.makeAlbumDom(main_festival, view_items));
    }

    drawList(view_list) {
        let view_items = view_list.map(x => this.makeListItemDom(x));
        this.$content.html(this.makeListDom(view_items));
    }

    makeListDom(v) {
        return `
               <div class="list">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style=" text-align: center; width: 5%;">번호</th>
                                <th style=" text-align: center; width: 50%;">제목</th>
                                <th style=" text-align: center; width: 20%;">기간</th>
                                <th style=" text-align: center; width: 15%;">장소</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${v.join('')}
                        </tbody>
                    </table>
                </div>
        `
    }

    makeListItemDom(x) {
        return `
                        <tr data-id="${x.id}" data-toggle="modal" data-target=".view_modal">
                                <td style="text-align: center;">${x.id}</td>
                                <td style="text-align: center;">${x.nm}</td>
                                <td style="text-align: center;">${x.dt}</td>
                                <td style="text-align: center;"><span class="tag">${x.area}</span></td>
                            </tr>
        `
    }

    makeAlbumDom(main_festival, view_items) {
        return `
             <div class="album">
                    <div class="main_festival" data-id=${main_festival.id} data-target='.view_modal'>
                        <img src="${main_festival.image_path}/${main_festival.images[0]}" alt="No Image" class="img_cover">
                        <div class="text">
                            <div class="title">
                                ${main_festival.nm}
                            </div>
                            <p>${main_festival.cn}</p>
                            <span>${main_festival.dt}</span>
                            <div class="btn_group">
                                <button class="btn0 btn2">
                                    자세히 보기
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="festivalList">
                        ${view_items.join('')}
                    </div>
                </div>
        `
    }

    makeAlbumItemDom(x) {
        return `
                    <div class="card" data-id="${x.id}" data-toggle="modal" data-target=".view_modal">
                            <img src="${x.image_path}/${x.images[0]}" alt="No Image" title='No Image'>
                            <div class="text">
                                <div class="title">
                                    ${x.nm}
                                </div>
                                <span>${x.dt}</span>
                            </div>
                            <div class="cnt flex_c">
                                ${x.images.length}
                            </div>
                        </div>
        `
    }



    getQueryString() {
        return location.search.substr(1).split("&").reduce((obj, item) => {
            let [key, value] = item.split("=");
            obj[key] = value;
            return obj;
        }, {});
    }

    getXML() {
        return $.ajax("/xml/festivalList.xml");
    }



    getDatas() {
        return Array.from(this.xml.querySelectorAll("item")).map(item => {
            return {
                id: item.querySelector("sn").innerHTML,
                no: item.querySelector("no").innerHTML,
                nm: item.querySelector("nm").innerHTML,
                area: item.querySelector("area").innerHTML,
                location: item.querySelector("location").innerHTML,
                dt: item.querySelector("dt").innerHTML,
                cn: item.querySelector("cn").innerHTML,
                images: Array.from(item.querySelectorAll("image")).map(x => x.innerHTML),
                image_path: `/xml/festivalImages/${item.querySelector("sn").innerHTML.padStart(3, "0")}_${item.querySelector("no").innerHTML}`
            }
        });
    }
}