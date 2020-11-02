window.addEventListener('load', () => {
    let c = new Current();
});

class Current {
    constructor() {
        this.datas;
        this.items;
        this.$tbody = $(".current table tbody");

        this.init();
    }

    async init() {
        this.datas = await this.getDatas();
        log(this.datas);
        this.items = this.datas.items;
        if (this.datas.statusCd != 200) {
            alert(this.datas.statusMsg);
            return;
        }

        if (localStorage.more) {
            this.render(this.items.splice(0, this.items.length - 1));
        }

        if (localStorage.scy) {
            $(window).scrollTop(localStorage.scy);
        }

        this.render(this.items.splice(0, 10));
        this.setEvent();

    }

    render(items) {
        items.forEach(item => {
            this.$tbody.append(this.makeDom(item))
        });
    }

    makeDom(item) {
        return `
                    <tr class="${item.result != 1 ? 'active' : ''}">
                        <td>${item.result}</td>
                        <td>${item.cur_unit}</td>
                        <td>${item.ttb}</td>
                        <td>${item.tts}</td>
                        <td>${item.deal_bas_r}</td>
                        <td>${item.bkpr}</td>
                        <td>${item.yy_efee_r}</td>
                        <td>${item.ten_dd_efee_r}</td>
                        <td>${item.kftc_bkpr}</td>
                        <td>${item.kftc_deal_bas_r}</td>
                        <td>${item.cur_nm}</td>
                    </tr>
        `
    }

    setEvent() {
        $(".btn_group > button").on("click", () => {
            this.render(this.items.splice(0, this.items.length));
            localStorage.more = true;
        });

        $(window).on("scroll", () => {
            let current = $(window).scrollTop() + $(window).height();
            let bottom = $('html').height();

            if (current >= bottom) {
                this.render(this.items.splice(0, this.items.length));
                localStorage.more = true;
            }

            localStorage.scy = $(window).scrollTop();
        });
    }


    getDatas() {
        return $.ajax('/restAPI/currentExchangeRate.php');
    }
}