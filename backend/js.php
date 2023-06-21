<script type="text/javascript">
let paymentDetail = []; 
let deliveryDetail = []; 
let months_th_mini = [ "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.", ];
var tabToggle = (bool) => $("button.nav-link").prop("disabled", bool);
$(function() {
    onLoad();  
});

function onLoad(){
    $('#reservationdate').datetimepicker({
        format: 'YYYY-MM-DD',
        defaultDate:new Date()
    });
    $('#deliverydate').datetimepicker({
        format: 'YYYY-MM-DD',
        defaultDate:new Date()
    }); 
    onGetDataPayment(); 
}

async function onGetDataPayment(){
    const pay_date = $("input[name='pay_date']").val() || moment(new Date).format('YYYY-MM-DD');
    $("#payment-data .pay-title").text(`รายชื่อส่งงวด ประจำวันที่ ${pay_date}`);
    onShowOverlay(function(){
        tabToggle(true);
        searchPayMent(pay_date).then( function(res){
            let customer = res?.map(m => m.cuscode);
            customer = customer.length > 0 ? [...new Set(customer)] : undefined;
            // console.log(pay_date, res, customer);
            $("#payment-data .card-payment").empty();
            $("#payment-data .card-payment").hide();
            if(!!customer){
                paymentDetail = res;
                for( let cus of customer){
                    let cust_pay = res.filter( f => f.cuscode == cus);
                    let row = 1;
                    let cusname = cust_pay[0]?.cusname;
                    let pay_count = cust_pay.filter( f => f.status == "ยังไม่ได้จ่าย").length;
                    let price_total = cust_pay.reduce( (a, b)=>( a + parseInt(b.mustpay)), 0);
                    let paid_total = cust_pay.reduce( (a, b)=>( a + parseInt(b.paid)), 0);
                    let checkPaid = paymentDetail.findIndex(f => f.status == "ยังไม่ได้จ่าย" && f.cuscode == cus);


                    let html_table = cust_pay.reduce( (a, b)=>{
                        let textStatus = (b.status == 'ยังไม่ได้จ่าย' && b.paydate < moment().format('YYYY-MM-DD')) ? "text-danger" : b.status == 'จ่ายแล้ว' ? "text-success" : "";
                        let tr = `
                        <tr class="text-left ${textStatus}" so="${b.socode}" ids="${b.id}">
                            <td>${row++}</td>
                            <td>${b.paydate}</td>
                            <td>${b.socode}</td>
                            <td>ง.${b.payround}/${b.installment}</td>
                            <td>${b.stcode}</td>
                            <td>${b.stname1}</td>
                            <td class="text-right">${parseInt(b.mustpay).toLocaleString('en-US', {maximumFractionDigits: 5, minimumFractionDigits: 2})}</td>
                            <td class="text-right">${parseInt(b.paid).toLocaleString('en-US', {maximumFractionDigits: 5, minimumFractionDigits: 2})}</td>
                            <td class="text-right">${(b.mustpay - b.paid).toLocaleString('en-US', {maximumFractionDigits: 5, minimumFractionDigits: 2})}</td>
                            <td class="text-center">
                                ${((b.status == 'จ่ายแล้ว') 
                                    ? `<span class="badge badge-success">${b.status}</span>`
                                    : `<a href="#" class="btn btn-xs btn-warning font-italic font-weight-bold" style="width: 100%;" onclick="onPayment(${b.id}, '${b.socode}', '${b.stcode}')">Pay</a>`
                                )} 
                            </td>
                        </tr>
                        `;
                        return a + tr;
                    }, "");

                    let html_card = `
                    <div class="card text-center">
                        <div class="card-header" style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);">
                            <div class="d-flex align-items-center" style="gap:10px;">
                                <div class="d-flex" style="gap:4px;">
                                    <span>${cusname}</span>
                                    <span class="translate-middle badge rounded-pill bg-danger align-items-center justify-content-center ${(checkPaid === -1) ? 'd-none' : 'd-flex'}" style="min-width: 26px;" id="cnt-${cus}">${pay_count}</span>
                                </div> 
                                <a href="javascript:void(0)" class="font-weight-bold text-white" onclick="onPaymentClipboard('${cus}')" ><i class="far fa-comment"></i></a>
                                <!--- <a href="javascript:void(0)" class="font-weight-bold text-white" ><i class="fas fa-image"></i></a> --->
                            </div> 
                        </div>
                        <div class="card-body"> 
                            <div class="mw-100 table-responsive">
                                <table name="table" id="payment-${cus}" class="table table-striped table-valign-top table-hovers text-nowrap pay-card m-0">
                                    <thead class="bg-dark">
                                        <tr style="text-align:left">  
                                            <th>ลำดับ</th>
                                            <th>กำหนดชำระ</th>
                                            <th>เลขที่ SO</th>
                                            <th>งวด</th>
                                            <th>รหัสสินค้า</th>
                                            <th>รายการสินค้า</th>
                                            <th class="text-right">จำนวนเงิน</th>
                                            <th class="text-right">จ่ายแล้ว</th>
                                            <th class="text-right">คงเหลือจ่าย</th>
                                            <th class="center">เลือกจ่าย</th>
                                        </tr>
                                    </thead> 
                                    <tbody class="text-nowrap">
                                        ${html_table}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6">ยอดรวมทั้งหมด</td>
                                            <td class="text-right underline-double">${price_total.toLocaleString('en-US', {maximumFractionDigits: 5, minimumFractionDigits: 2})}</td>
                                            <td class="text-right underline-double">${paid_total.toLocaleString('en-US', {maximumFractionDigits: 5, minimumFractionDigits: 2})}</td>
                                            <td class="text-right underline-double">${(price_total-paid_total).toLocaleString('en-US', {maximumFractionDigits: 5, minimumFractionDigits: 2})}</td>
                                            <td>
                                            ${((checkPaid === -1) 
                                                ? `<span class="badge badge-primary">ชำระเสร็จสิ้น</span>`
                                                : `<a href="#" class="btn btn-xs btn-primary font-italic font-weight-bold" style="width: 100%;" onclick="onPaymentAll('${cus}')">Pay All</a>`
                                            )}
                                            </td>
                                            <!-- <td><i class="fas fa-times text-danger" style="width: 100%;"></i></td> -->
                                        </tr>
                                    </tfoot>
                                </table>
                            </div> 
                        </div>
                    </div>                     
                    `; 
                    $("#payment-data .card-payment").append(html_card);
                }
            }else{
                $("#payment-data .card-payment").html(`<h5>ไม่พบข้อมูล...</h5>`);
            }

            onHideOverlay(function(){  
                $("#payment-data .card-payment").show("drop", 300); 
                tabToggle(false); 
                $("#payment-data-tab[aria-controls=payment-data]").addClass("loaded");
            } );
        });
    });

}

async function onGetDataDelivery(){
    const deldate = $("input[name='deldate']").val() || moment(new Date).format('YYYY-MM-DD');
    $("#delivery-data .pay-title").text(`รายชื่อค้างส่งสินค้า ประจำวันที่ ${deldate}`);
    onShowOverlay(function(){
        tabToggle(true);
        searchDelevery(deldate).then( function(res){
            let customer = res?.map(m => m.cuscode);
            customer = customer.length > 0 ? [...new Set(customer)] : undefined;
            // console.log(pay_date, res, customer);
            $("#delivery-data .card-delivery").empty();
            $("#delivery-data .card-delivery").hide();
            if(!!customer){
                deliveryDetail= res;
                for( let cus of customer){
                    let cust_del = res.filter( f => f.cuscode == cus);
                    let row = 1;
                    let cusname = cust_del[0]?.cusname;
                    let del_count = cust_del.filter( f => f.status == 'ยังไม่ส่งของ').length;
                    let amount_total = cust_del.reduce( (a, b)=>( a + parseInt(b.amount)), 0); 
                    let price_total = cust_del.reduce( (a, b)=>( a + parseInt(b.price)), 0); 

                    let checkPaid = deliveryDetail.findIndex(f => f.status == "ยังไม่ส่งของ" && f.cuscode == cus);

                    let html_table = cust_del.reduce( (a, b)=>{
                        let textStatus = (b.status == 'ยังไม่ส่งของ' && b.deldate < moment().format('YYYY-MM-DD')) ? "text-danger" : b.status == 'ส่งสินค้าแล้ว' ? "text-success" : "";
                        let tr = `
                        <tr class="text-left ${textStatus}" so="${b.socode}">
                            <td>${row++}</td>
                            <td>${b.deldate}</td>
                            <td>${b.socode}</td>
                            <td>${b.stcode}</td>
                            <td>${b.stname1}</td>
                            <td class="text-right">${parseInt(b.amount).toLocaleString('en-US', {maximumFractionDigits: 5, minimumFractionDigits: 2})}</td>
                            <td class="text-left">${b.unit}</td>
                            <td class="text-right">${parseInt(b.price).toLocaleString('en-US', {maximumFractionDigits: 5, minimumFractionDigits: 2})}</td>
                            <td class="text-center">
                                ${((b.status == 'ส่งสินค้าแล้ว') 
                                    ? `<span class="badge badge-success">${b.status}</span>`
                                    : `<a href="#" class="btn btn-xs btn-warning font-italic font-weight-bold" style="width: 100%;" onclick="onDelivery('${b.socode}', null)">Delivered</a>`
                                )}
                            </td>
                        </tr>
                        `;
                        return a + tr;
                    }, "");

                    let html_card = `
                    <div class="card text-center">
                        <div class="card-header" style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);">
                            <div class="d-flex align-items-center" style="gap:10px;">
                                <div class="d-flex" style="gap:4px;">
                                    <span>${cusname}</span>
                                    <span class="translate-middle badge rounded-pill bg-danger align-items-center justify-content-center ${(checkPaid === -1) ? 'd-none' : 'd-flex'}" style="min-width: 26px;" id="cnt-del-${cus}">${del_count}</span>
                                </div> 
                                <a href="javascript:void(0)" class="font-weight-bold text-white" onclick="onDeliveryClipboard('${cus}')" ><i class="far fa-comment"></i></a> 
                            </div> 
                        </div>
                        <div class="card-body"> 
                            <div class="mw-100 table-responsive">
                                <table name="table" id="delivery-${cus}" class="table table-striped table-valign-middle table-hovers text-nowrap del-card m-0">
                                    <thead class="bg-dark">
                                        <tr style="text-align:left">  
                                            <th>ลำดับ</th>
                                            <th>กำหนดจัดส่ง</th>
                                            <th>เลขที่ SO</th>
                                            <th>รหัสสินค้า</th>
                                            <th>รายการสินค้า</th>
                                            <th class="text-right">จำนวน</th>
                                            <th class="text-left">หน่อย</th>
                                            <th class="text-right">ราคา</th>
                                            <th class="center">เลือกส่ง</th>
                                        </tr>
                                    </thead> 
                                    <tbody class="text-nowrap">
                                        ${html_table}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5">ยอดรวมทั้งหมด</td>
                                            <td class="text-right underline-double">${amount_total.toLocaleString('en-US', {maximumFractionDigits: 5, minimumFractionDigits: 2})}</td>
                                            <td class="text-left underline-double"></td>
                                            <td class="text-right underline-double">${price_total.toLocaleString('en-US', {maximumFractionDigits: 5, minimumFractionDigits: 2})}</td>
                                            <td>
                                                ${((checkPaid === -1) 
                                                    ? `<span class="badge badge-primary">ส่งสินค้าเสร็จสิ้น</span>`
                                                    : `<a href="#" class="btn btn-xs btn-primary font-italic font-weight-bold" style="width: 100%;" onclick="onDelivery(null, '${cus}')">Delivered All</a>`
                                                )} 
                                            </td>
                                            <!-- <td><i class="fas fa-times text-danger" style="width: 100%;"></i></td> -->
                                        </tr>
                                    </tfoot>
                                </table>
                            </div> 
                        </div>
                    </div>                     
                    `; 
                    $("#delivery-data .card-delivery").append(html_card);
                }
            }else{
                $("#delivery-data .card-delivery").html(`<h5>ไม่พบข้อมูลค้างส่ง...</h5>`);
            }

            onHideOverlay(function(){  
                $("#delivery-data .card-delivery").show("drop", 300); 
                tabToggle(false);
                $("#delivery-data-tab[aria-controls=delivery-data]").addClass("loaded");
            });
        });
    });

}

function searchPayMent(date){
    return $.get("ajax/get_payment.php", {q:date});
}

function searchDelevery(date){
    return $.get("ajax/get_delivery.php", {q:date});
}
 

function onShowOverlay(fn = function(){}, dl =  200){
    $(".overlay--loading").show(dl, function(){ fn() });
}

function onHideOverlay(fn = function(){}, dl =  200){
    setTimeout( function(){
        $(".overlay--loading").hide(dl, function(){ fn() }); 
    }, 1400)
}

function onPayment(id, socode, stcode){
    const modal = $("#modal-pay");
    modal.find(".modal-title span.t-title").text(`ชำระเงิน [${stcode.replace(/<br>/g, ',')}]`);
    modal.attr("sid", id);
    modal.attr("socode", socode);
    modal.removeAttr("all-payment");
    modal.modal("show");
}

function onPaymentAll(cuscode){
    const modal = $("#modal-pay");
    modal.find(".modal-title span.t-title").text(`ชำระเงิน [ทั้งหมด]`);
    modal.attr("all-payment", "true"); 
    modal.attr("cuscode", cuscode);
    modal.modal("show");
} 

function onPaymentClipboard(cus) {
    //❎❌⚠️
    const pay_date = $("input[name='pay_date']").val() || moment(new Date).format('YYYY-MM-DD');
    let this_month = (new Date(pay_date)).getMonth();
    let this_day = (new Date(pay_date)).getDate();
    let cust_pay = paymentDetail.filter( f => f.cuscode == cus);
    let cusname = cust_pay[0]?.cusname;
    
    let price_total = cust_pay.reduce( (a, b)=>( a + parseInt(b.mustpay)), 0);
    let paid_total = cust_pay.reduce( (a, b)=>( a + parseInt(b.paid)), 0); 
    let head = `${cus}(${cusname})[${String(this_day).padStart(2, '0')}/${months_th_mini[this_month]}]`;
    let bodyList = cust_pay.map(m => {
        let textStatus = (m.status == 'ยังไม่ได้จ่าย' && m.paydate < moment().format('YYYY-MM-DD')) ? "❌" : m.status == 'จ่ายแล้ว' ? "✅" : "⚠️";
        return `${textStatus}${m.stname1}(ง.${m.payround}/${m.installment})=${parseInt(m.mustpay) - parseInt(m.paid)}`; 
    });
    let cp = `${head}\nรายการ/ยอดส่ง:\n${bodyList.join("\n")}\nยอดส่งรวม=${(price_total-paid_total)}`
    //console.log(bodyList);
    navigator.clipboard.writeText(cp);
    toast(`คัดลอกเรียบร้อย`, 'success');
}

function onDeliveryClipboard(cus) {
    //❎❌⚠️
    const del_date = $("input[name='deldate']").val() || moment(new Date).format('YYYY-MM-DD');
    let this_month = (new Date(del_date)).getMonth();
    let this_day = (new Date(del_date)).getDate();
    let cust_del = deliveryDetail.filter( f => f.cuscode == cus);
    let cusname = cust_del[0]?.cusname; 
 
    let amount_total = cust_del.reduce( (a, b)=>( a + parseInt(b.amount)), 0); 

    let head = `${cus}(${cusname})[${String(this_day).padStart(2, '0')}/${months_th_mini[this_month]}]`;
    let bodyList = cust_del.map(m => {
        let textStatus = (m.status == 'ยังไม่ส่งของ' && m.deldate < moment().format('YYYY-MM-DD')) ? "❌" : m.status == 'ส่งสินค้าแล้ว' ? "✅" : "⚠️";
        return `${textStatus}${m.stname1}(${m.socode})=${parseInt(m.amount)}${m.unit}`; 
    });
    let cp = `${head}\nรายการส่งสินค้า:\n${bodyList.join("\n")}\nจำนวนรวม=${amount_total}`
    //console.log(bodyList);
    navigator.clipboard.writeText(cp);
    toast(`คัดลอกเรียบร้อย`, 'success');
}

$(document).on("click", "#dashBoardTab .nav-item>button.nav-link", function(){
    let btn = $(this);
    if(!btn.hasClass("loaded")){
        let dataTarget = btn.attr("data-target");
        switch(dataTarget){
            case "#payment-data":
                onGetDataPayment();
                break;
            case "#delivery-data":
                onGetDataDelivery();
                break;
        }
    }
});

$(document).on("click", "#modal-pay #summit-payment", function(){
    const modal = $(this).closest(".modal"); 
    const checkall = modal.attr("all-payment"); 
    if(!!checkall){
        allPayment(modal);
    }else{
        singlePayment(modal); 
    }
 
});

$(document).on("hidden.bs.modal", "#modal-pay", async function(e) { 
    let modal = $(this);
    modal.find("[name=payment][type=radio]").prop("checked", false);
});

function singlePayment(modal){
    const payment = modal.find("[name=payment]:checked").val();
    const pay_date = $("input[name='pay_date']").val() || moment(new Date).format('YYYY-MM-DD');
    const socode = modal.attr("socode");
    const id = modal.attr("sid");
    const paym = paymentDetail.filter( f => f.id == id)[0];
    if (!!payment) {
        // //Swal.fire('อยู่ระหว่างการพัฒนา', "กำลังคิดรูบแบบใบเสร็จสำหรับแบ่งชำระ", 'info');
        objParm = {
            ...paym,
            socode: socode,
            id: id,
            pay_date:pay_date,
            retype:payment,
        }; 

        //console.log(objParm);

        modal.modal("hide");
        $.post("ajax/set_payment.php", objParm, "json")
        .then( async (r) => { 
            console.log(r);
            onUpdatePaymentTable(`#payment-${paym.cuscode}`, paym);
            await onAttachment(r.code, socode);
        })
        .catch( error => { toast(`เกิดข้อผิดพลาด`, 'error'); });

        toast(`ชำระเสร็จสิ้น`, 'success');
    }else{
        Swal.fire('เลือกการชำระเงิน', "กรุณาเลือกการชำระเงิน", 'warning');
    }
}

async function allPayment(modal){
    const payment = modal.find("[name=payment]:checked").val();
    const pay_date = $("input[name='pay_date']").val() || moment(new Date).format('YYYY-MM-DD');
    const cuscode = modal.attr("cuscode"); 
    if (!!payment) {
        const pay_data = paymentDetail.filter( f => f.cuscode == cuscode && f.status == "ยังไม่ได้จ่าย");
        
        modal.modal("hide");
        // console.log(pay_data, cuscode);
        // debugger;
        // //Swal.fire('อยู่ระหว่างการพัฒนา', "กำลังคิดรูบแบบใบเสร็จสำหรับแบ่งชำระ", 'info');
        for(let res of pay_data){
            // console.log(res);
            objParm = {
                ...res,
                socode: res.socode,
                id: res.id,
                pay_date:pay_date,
                retype:payment,
            }; 

            //console.log(objParm);

            const r = await $.post("ajax/set_payment.php", objParm, "json").catch( error => { 
                toast(`เกิดข้อผิดพลาด`, 'error'); 
                throw new Error(error);
            });


            console.log(r);
            onUpdatePaymentTable(`#payment-${res.cuscode}`, res);
            await onAttachment(r.code, res.socode);
        };

        toast(`ชำระเสร็จสิ้น`, 'success');
    }else{
        Swal.fire('เลือกการชำระเงิน', "กรุณาเลือกการชำระเงิน", 'warning');
    }

}

function onDelivery(socode, cuscode){
    let delivery  = []; 
    Swal.fire({
        title: 'ต้องการยืนยันการส่งสินค้าใช่ไหม',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยันส่งสินค้า'
    }).then( async (result) => {
        if (result.isConfirmed) {
            if(!!cuscode) delivery = deliveryDetail.filter( f => f.cuscode === cuscode);
            else delivery =  deliveryDetail.filter(f => f.socode === socode);

            for(let del of delivery){
                objParm = { 
                    socode: del.socode,
                }; 

                const r = await $.post("ajax/set_delivery.php", objParm, "json")
                .catch( error => { toast(`เกิดข้อผิดพลาด`, 'error'); });

                // console.log(r);
                onUpdateDeliveryTable(`#delivery-${del.cuscode}`, del);
            }
        } 
    });
}

function onUpdatePaymentTable(table, data){
    const index = paymentDetail.findIndex(f => f.status == "ยังไม่ได้จ่าย" && f.id == data.id);

    paymentDetail[index].paid = data.mustpay;
    paymentDetail[index].status = "จ่ายแล้ว";
    
    let cust_pay = paymentDetail.filter( f => f.cuscode == data.cuscode );

    let pay_count = cust_pay.filter( f => f.status == "ยังไม่ได้จ่าย").length;
    let price_total = cust_pay.reduce( (a, b)=>( a + parseInt(b.mustpay)), 0);
    let paid_total = cust_pay.reduce( (a, b)=>( a + parseInt(b.paid)), 0);

    let checkPaid = paymentDetail.findIndex(f => f.status == "ยังไม่ได้จ่าย" && f.cuscode == data.cuscode);
 
    
    const count_unpay = $(`#cnt-${data.cuscode}`).text(pay_count);

    if(pay_count < 1) 
        count_unpay.removeClass("d-flex").addClass("d-none");
    else 
        count_unpay.text(pay_count);

    const tr = $(table).find(`tr[ids=${data.id}]`);
    tr.removeClass("text-danger").addClass("text-success");
    tr.find("td").eq(7).text(parseInt(data.paid).toLocaleString('en-US', {maximumFractionDigits: 5, minimumFractionDigits: 2}));
    tr.find("td").eq(8).text(0);
    tr.find("td").eq(9).html(`<span class="badge badge-success">จ่ายแล้ว</span>`);

    const trfoot = $(table).find("tfoot>tr"); 
    trfoot.find("td").eq(2).text(paid_total.toLocaleString('en-US', {maximumFractionDigits: 5, minimumFractionDigits: 2}));
    trfoot.find("td").eq(3).text((price_total-paid_total).toLocaleString('en-US', {maximumFractionDigits: 5, minimumFractionDigits: 2}));
    trfoot.find("td").eq(4).html(
        (checkPaid === -1) 
        ? `<span class="badge badge-primary">ชำระเสร็จสิ้น</span>`
        : `<a href="#" class="btn btn-xs btn-primary font-italic font-weight-bold" style="width: 100%;" onclick="onPaymentAll('${data.cuscode}')">Pay All</a>`
    );
}

function onUpdateDeliveryTable(table, data){
    console.log(data);
    const index = deliveryDetail.findIndex(f => f.status == "ยังไม่ส่งของ" && f.cuscode == data.cuscode);

    deliveryDetail[index].paid = data.mustpay;
    deliveryDetail[index].status = "ส่งสินค้าแล้ว";
    
    let cust_del = deliveryDetail.filter( f => f.cuscode == data.cuscode );

    let del_count = cust_del.filter( f => f.status == "ยังไม่ส่งของ").length; 

    let checkPaid = deliveryDetail.findIndex(f => f.status == "ยังไม่ส่งของ" && f.cuscode == data.cuscode);
 
    
    const count_unpay = $(`#cnt-del-${data.cuscode}`);

    if(del_count < 1) 
        count_unpay.removeClass("d-flex").addClass("d-none");
    else 
        count_unpay.text(del_count);

    const tr = $(table).find(`tr[so="${data.socode}"]`);
    tr.removeClass("text-danger").addClass("text-success");
 
    tr.find("td").eq(8).html(`<span class="badge badge-success">ส่งสินค้าแล้ว</span>`);

    const trfoot = $(table).find("tfoot>tr");  
    trfoot.find("td").eq(4).html(
        (checkPaid === -1) 
        ? `<span class="badge badge-primary">ส่งสินค้าเสร็จสิ้น</span>`
        : `<a href="#" class="btn btn-xs btn-primary font-italic font-weight-bold" style="width: 100%;" onclick="onDelivery('${data.socode}', null)">Pay All</a>`
    );
}

$(document).on("click", "#summit-file", function() {
    const modal = $(this).parents("div.modal");
    const n = modal.find(".modal-body input[name=atthFile]");
    const h = modal.find(".modal-body input[name=attname]");
    const e = modal.find(".f-empty");
    const a = modal.find("[attached]");
    const f = n[0].files[0];
    if (!f && a.length == 0) {
        e.addClass("border-danger");
        return;
    }
    if (!h.val()) {
        h.addClass("border-danger");
        const s = h.closest(".form-group").find("label small");
        s.html(
            "<strong class='text-danger font-italic'>กรุณากรอกข้อมูลให้ครบถ้วน</strong>"
        );
        s.removeClass("d-none");
        return;
    }
    const d = JSON.parse(modal.attr("data-attach") || null);
    if (d) {
        let i = _fileList.findIndex((c => c.code == d.code));
        let p = d.url.split("//");
        let r = p[p.length - 1];
        _fileList[i].attname = h.val();
        _fileList[i].file = f || {
            name: `<a class="font-weight-bold text-monospace" href="ajax/load_attachfile.php?path=${d.url}" target="_BLANK" style="text-decoration: underline; color: #007bff !important;">${r}</a>`
        };
        _fileList[i]["upd"] = true;
        _fileList[i]["udf"] = !!f;
        modal.modal("hide");
    } else {
        _fileList.push({
            attname: h.val(),
            file: f
        });
        modal.modal("hide");
    }

    //$("#attachFileList")

});

 
$(document).on("shown.bs.modal", "#modal-attach-list", function() {  
    _fileList = [];
    _filesDelete = [];
    _fileFormData = [];
    _attachList = [];
    genarateRow("#attachFileList");
})

// $(document).on("hidden.bs.modal", "#modal-attach-list", function() {
//     const modal = $(this);
//     const pocode = modal.attr("ref-code");
//     const acction = modal.attr("ref-actn");
//     modal.removeAttr("ref-code");
//     modal.removeAttr("ref-actn");
//     _fileList = [];
//     _filesDelete = [];
//     _fileFormData = [];
//     _attachList = [];
//     genarateRow("#attachFileList");
//     document.body.style.overflow = "auto"
//     if (acction == "add") {
//         toast(`สร้าง PO ${pocode} เสร็จสิ้น`);
//         setTimeout(() => {
//             window.location.reload();
//         }, 1200);
//     }; 
// });

$(document).on("hidden.bs.modal", "#modal-attach", function() {
    $("body").addClass("modal-open");
    const modal = $(this);
    const ac_table = modal.attr("actable");
    modal.removeAttr("data-attach");
    onClearmModal(modal);
    genarateRow(ac_table);
});

$(document).on("change", "[req]", function() {
    let h = $(this);
    if (h.val()) {
        h.removeClass("border-danger");
        const s = h.closest(".form-group").find("label small");
        s.html("");
        s.addClass("d-none");
    } else {
        h.addClass("border-danger");
        const s = h.closest(".form-group").find("label small");
        s.html(
            "<strong class='text-danger font-italic'>กรุณากรอกข้อมูลให้ครบถ้วน</strong>"
        );
        s.removeClass("d-none");
    }
});

$(document).on("click", "#cancel-file", function() {
    //const modal = $(this).parents("div.modal");
    onClearmModal($(this).parents("div.modal"));
});

$(document).on("click", "#attachFile", function() {
    const btn = $(this);
    const recode = btn.attr("recode");
    uploadFiles(recode, "upd")?.then(r => {
        _filesDelete = [];
        _fileFormData = [];

        getAttachmentList(recode);
    });
});
 

async function onAttachment(code = null, socode = "no socode") {
    const modal = $("#modal-attach-list");
    modal.find(".modal-title").text(`แนบไฟล์ SO - [${socode}]`);
    modal.attr("ref-code", code); 

    modal.modal("show");
    return new Promise( async function(r){
        $("#modal-attach-list").on("hidden.bs.modal", function() {
            const modal = $(this);
            const pocode = modal.attr("ref-code"); 
            modal.find(".modal-title").text(`แนบไฟล์`);
            modal.removeAttr("ref-code"); 
            _fileList = [];
            _filesDelete = [];
            _fileFormData = [];
            _attachList = [];
            genarateRow("#attachFileList"); 

            r();
        });
    })
}

function openEditFile(e) {
    let elm = $(e.target);
    let modal = elm.parents("div.modal");
    const recode = modal.attr("ref-code");
    getAttachmentList(recode).then(r => {
        receiptAttachment(recode, "upd");
    });
}

function receiptAttachment(recode = null, acction = "add") {
    const modal = $("#modal-attach-list");
    modal.attr("ref-code", recode);
    modal.attr("ref-actn", acction);

    modal.modal("show");
}

async function getAttachmentList(recode) {
    return await $.get("ajax/upload_attachment.php", {
        c: recode
    }, function(res) {
        _filesDelete = [];
        _fileList = [];
        let attach = _attachList = res;
        for (let i in attach) {
            let pth = attach[i].url.split("//");
            let _f = pth[pth.length - 1];
            _fileList.push({
                attname: attach[i].attname,
                file: {
                    name: `<a class="font-weight-bold text-monospace" href="ajax/load_attachfile.php?path=${attach[i].url}" target="_BLANK" style="text-decoration: underline; color: #007bff !important;">${_f}</a>`
                },
                attached: true,
                code: attach[i].code,
            })
        };
        genarateRow("#attachFileList");
        return res;
    });
}

function uploadAttachment(e) {
    let btn = $($(e)[0].target);
    let modal = btn.parents("div.modal");
    const pocode = modal.attr("ref-code");
    const acction = modal.attr("ref-actn");
    uploadFiles(pocode, modal).then(r => {
        modal.modal("hide");
    });
}

async function uploadFiles(recode, modal) {
    let formData = new FormData();
    if (_fileList.length > 0 || _filesDelete.length > 0) {
        let _i = 0;
        let _f = _fileList;
        //let isUpdate =  !!(_f.filter(f => f.attached)[0]);
        let fileUpdate = _f.filter(f => !!f?.upd);
        let fileAttach = _f.filter(f => !!!f.attached);
        for (let f of fileUpdate) {
            if (f.udf) formData.append(`file${f.code}`, f.file);
            let a = (_attachList.filter(e => e.code == f.code))[0];
            let p = a.url.split("//");
            let r = p[p.length - 1];
            _fileFormData.push({
                attname: f.attname,
                file_name: !f.udf ? f.attname : null,
                code: f.code,
                url: a.url,
                percode: a.percode,
                fname: r.slice(0, r.lastIndexOf(".")),
            });
        }

        for (let f of fileAttach) {
            formData.append("file[]", f.file);
            formData.append("attname[]", f.attname);
        }

        formData.append("fileData", JSON.stringify(_fileFormData));
        formData.append("fileDelete", JSON.stringify(_filesDelete));
        formData.append("recode", recode);
        formData.append("action", "add");
        return await $.ajax({
            type: "POST",
            url: "receipt/ajax/upload_attachment.php",
            processData: false,
            contentType: false,
            data: formData,
            success: async function(result) {
                if (result.status == 1) // Success
                {
                    toast(result.message, 'success');
                    //modal.modal("hide");
                } else {
                    toast("เกิดปัญหาในหารเพิ่มข้อมูลกรุณาลองใหม่อีกครั้ง", 'error');
                }

                return result;
            },
            error: function(error) {
                let mes = JSON.parse(error?.responseText || "{}");
                toast(mes?.message, 'error');

                return error;
            }
        });
    } else return null;
}

async function attached(e, t) {
    const FILE_REQUIRED = ["application/pdf", "image/jpg", "image/png", "image/jpeg"];
    const modal = $(e.target).parents("div.modal");
    const n = $(e.target);
    const f = n[0].files[0];
    if (!FILE_REQUIRED.includes(f.type)) {
        await Swal.fire(`ไฟล์ชนิดนี้ไม่ได้รับอนุญาตให้แนบ`, `กรุณาแนบไฟล์นามสกุลที่อนุญาติเท่านั้น`, 'warning');
        n.val(null);
        return;
    }
    const f_result = modal.find(".file-result");
    const t_result = $(f_result.html());
    const e_result = f_result.find(".f-empty");
    f_result.find("[attached]").remove();
    if (f?.name) {
        t_result.find(".mi").html(`<i class="far fa-file-alt"></i>`);
        t_result.find(".ms").html(`<strong>${f.name}</strong>`);
        t_result.attr("attached", "");
        e_result.removeClass("d-flex").addClass("d-none");
        t_result.removeClass("border-danger");
        f_result.append(t_result);
    } else {
        e_result.removeClass("d-none").addClass("d-flex border-danger");
    }
}

function onClearmModal(modal) {
    const e = modal.find(".f-empty");
    const f = modal.find(".modal-body [attached]");
    const h = modal.find(".modal-body input[name=attname]");
    const a = modal.find(".modal-body input[name=atthFile]");
    const s = h.closest(".form-group").find("label small");
    f.remove();
    h.val("").removeClass("border-danger");
    a.val(null);
    s.find("strong").remove();
    e.removeClass("d-none border-danger").addClass("d-flex");
    modal.modal("hide");

}

function genarateRow(t) {
    let tr = [];
    let f = _fileList;
    if (_fileList.length == 0) {
        $(`${t} tbody`).html(
            `<tr class="bg-transparent">
                <td colspan="4" align="left" class="bg-transparent border-0 text-secondary">ไม่มีข้อมูลไฟล์</td>
            </tr>`
        );

        return;
    }
    for (let i in _fileList) {
        let ti = f[i]?.attname;
        let fi = f[i]?.file;
        tr.push(
            `<tr>
                <td class="bg-white">${parseInt(i) + 1}</td>
                <td class="bg-white">${ti}</td>
                <td class="bg-white text-nowrap text-truncate" style='max-width: 300px;'>${fi.name}</td>
                <td class="bg-white">
                    <button type="button" class="btn-dl btn btn-xs btn-danger rounded-sm" style="width: 30px;" onclick="removeRow(this, ${i})" >
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    ${(!!f[i].attached ? `
                    <button type="button" class="btn-ed btn btn-xs btn-info rounded-sm" style="width: 30px;" onclick="editRow(this, ${f[i].code})" >
                        <i class="fas fa-pencil-alt"></i>
                    </button>`:""
                    )}
                </td>
            </tr>`
        );
    }
    setTimeout(() => {
        $(`${t} tbody`).html(tr.join(""));
    }, 20);

}

async function editRow(e, index) {
    let a = (_attachList.filter((f) => f.code == index))[0]
    if (!a) {
        await toast("ไม่พบข้อมูลไฟล์", 'error');
        return;
    }
    const path = a.url.split("//");
    const name = path[path.length - 1];
    const modal = $("#modal-attach");
    const f_result = modal.find(".file-result");
    const t_result = $(f_result.html());
    const e_result = f_result.find(".f-empty");

    f_result.find("[attached]").remove();
    t_result.find(".mi").html(`<i class="far fa-file-alt"></i>`);
    t_result.find(".ms").html(`<strong>${name}</strong>`);
    t_result.attr("attached", "");
    e_result.removeClass("d-flex").addClass("d-none");
    t_result.removeClass("border-danger");
    f_result.append(t_result);

    const h = modal.find(".modal-body input[name=attname]");
    h.val(a.attname);

    let t = $(e).closest("table");

    modal.attr("data-attach", JSON.stringify(a));
    modal.attr("actable", `#${t.attr("id")}`);

    modal.modal("show");
}

function removeRow(e, index) {
    let t = $(e).closest("table");
    let fil = _attachList?.filter((f, i) => i == index);
    if (Array.isArray(fil) && !!fil[0]) {
        let f = fil[0];
        let p = f.url.split("//");
        let r = p[p.length - 1];
        _filesDelete.push({
            code: f.code,
            url: f.url,
            name: r,
            pocode: f.pocode
        });
        _attachList.splice(index, 1);
    }
    _fileList.splice(index, 1);
    genarateRow(`#${t.attr("id")}`);
}

function openMgnFile(t) {
    let m = $("#modal-attach");
    m.attr("actable", t);
    m.modal("show");
}
</script>
 
 