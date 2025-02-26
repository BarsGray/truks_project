// const api_url = 'https://oapi-calc-service-stage.alfaleasing.ru/alfa-leasing-oapi-calc-service'

// async function get_url(url) {

//   const valutes = await fetch(url).then(
//     successResponse => {
//       if (successResponse.status != 200) {
//         return null
//       } else {
//         return successResponse.json()
//       }
//     },
//     failResponse => {
//       return null
//     }
//   )
// }

function toNumber(value) {
  return parseInt(value.replace(/\s+/g, ''), 10)
}

function formatCurrency(value) {
  console.log('Before', value)
  value = String(value)
  value = value.replace(/\..*/g, '')
  value = value.replace(/[\D\s_\-]+/g, "")  // вставляем только цифры
  value = value ? parseInt(value, 10) : 0
  console.log('After', value)
  return (value === 0) ? "" : value.toLocaleString("ru-RU")  // вставляем delimiters
}

function doFormat(value, pattern, mask) {
  // удаляем все нечисловые значения из значения
  const strippedValue = value.replace(/[^0-9]/g, "")

  // преобразуем строку-значение в массив символов
  const chars = strippedValue.split('')


  let count = 0
  let formatted = ''

  // форматируем строку
  for (let i = 0; i < pattern.length; i++) {
    const char = pattern[i]
    if (chars[count]) {
      if (/\*/.test(char)) {
        formatted += chars[count]
        count++
      } else {
        formatted += char
      }
    }
    else if (mask) {
      const splittedMask = mask.split('')

      if (splittedMask[i]) {
        formatted += splittedMask[i]
      }
    }
  }

  return formatted
}

// проходимся по каждому элементу назначая на них обработчики
// нажатия клавиш
document.querySelectorAll('[data-mask]').forEach(function (e) {


  function format(elem) {
    const val = doFormat(elem.value, elem.getAttribute('data-format'))
    elem.value = doFormat(elem.value, elem.getAttribute('data-format'), elem.getAttribute('data-mask'))

    if (elem.createTextRange) {
      var range = elem.createTextRange()
      range.move('character', val.length)
      range.select()
    } else if (elem.selectionStart) {
      elem.focus()
      elem.setSelectionRange(val.length, val.length)
    }
  }

  e.addEventListener('keyup', function () {
    format(e)
  })

  e.addEventListener('keydown', function () {
    format(e)
  })

  format(e)
})

document.addEventListener("DOMContentLoaded", async () => {
  // Get valutes

  // // const cbr_url = 'https://www.cbr-xml-daily.ru/latest.js'
  // const cbr_url = 'https://www.cbr.ru/scripts/XML_daily.asp'
  // const r = /<Name>Китайский юань<\/Name>\r<Value>([\d+,]*?)<\/Value>/gm
  // // const cbr_url = 'https://www.cbr-xml-daily.ru/latest.js'
  // const valutes = await fetch(cbr_url,
  //   {
  //     mode: 'no-cors',
  //     method: 'GET',
  //     headers: {
  //       Accept: 'application/xml',
  //     },
  //   }).then(successResponse => {
  //   return successResponse.text()
  // })
  // const matches = valutes.match(r)
  // debugger
  const formatter = new Intl.NumberFormat('ru-RU', {
    style: 'currency',
    currency: 'RUB',
    symbol: false,
    maximumFractionDigits: 0

  })

  function appendValutes(el) {
    const bdi = document.createElement("bdi")
    bdi.classList.add("rub")
    bdi.innerHTML = formatter.format(to_rub(el.textContent.replace(/[^\d]/g, '')))

    el.parentElement.appendChild(bdi)
  }
  // Add rub amounts
  // document.querySelectorAll('bdi').forEach(price => {
  //   appendValutes(price)
  // })

  // Get DOM elements
  const amount = document.getElementById("amount")
  const amount_range = document.getElementById("amount-range")
  const amount_range_max = document.getElementById("amount-range-max")
  const prepay = document.getElementById("prepay")
  const select_products = document.getElementById("select-products")
  const prepay_percent = document.getElementById("prepay-percent")
  const form_calc = document.getElementById("form-calc")
  const prepay_range = document.getElementById("prepay-range")
  const duration_range = document.getElementById("duration-range")
  const calc_image = document.getElementById("calc-image")

  function to_rub(amount) {

    // const rub = Math.floor(parseFloat(amount) * parseFloat(window.valutes.replace(',', '.')))

    // console.log('Convert', amount, rub)
    // return rub

    return amount
  }

  function from_rub(amount) {
    return parseInt(
      amount
        .replace(/([^\d,])/g, '')
        .replace(/,/g, '.')
    )
  }

  async function recalc() {
    // const calcs = '/wp-content/plugins/calc-leasing/calc.php';
    // redemption_amount = from_rub(duration_range.getAttribute('max')) * 10 / 100



    // let request = JSON.stringify({
    //   "term": from_rub(duration.value),
    //   "price": from_rub(amount_range.getAttribute('max')),
    //   "advance": {
    //     "percent": 10,
    //     "amount": from_rub(prepay.value)
    //   },
    //   // "agent_commission": 2,
    //   "redemption_amount": 1200
    // })
    // console.log("Calc", request)
    // console.log("redemption_amount", redemption_amount+1)
    // let data = await fetch(calcs, {
    //   method: 'POST',
    //   headers: {
    //     'Accept': 'application/json',
    //   },
    //   body: request,
    // }).then(successResponse => { return successResponse.json() })

    // ret = ''
    // if (data['error']) {
    //   ret = `<dl class="error">
    //       <dt>${data['error']}</dt>
    //       <dd>${data['message']}</dd>
    //     </dl>`
    // } else {
    //   ret = `<dl>
    //     <dt>${data['appreciation_percent_description']}</dt>
    //     <dd>${data['appreciation_percent']}</dd>

    //     <dt>${data['deal_amount_description']}</dt>
    //     <dd>${data['deal_amount']}</dd>

    //     <dt>${data['deal_amount_with_economy_description']}</dt>
    //     <dd>${data['deal_amount_with_economy']}</dd>


    //   </dl>`
    // }
    // document.querySelector('#result').innerHTML = ret

    // console.log(data)
  }

  async function update_prepay() {

    const option = select_products.options[select_products.selectedIndex];
    const dataprice = to_rub(option.getAttribute("dataprice"))
    amount.value = formatCurrency(dataprice)

    amount_range.value = dataprice
    prepay.value = formatCurrency(Math.floor(dataprice * prepay_percent.value / 100))

    amount_range.setAttribute('max', dataprice)
    amount_range_max.textContent = formatCurrency(dataprice) + ' ₽'
    amount_range.value = dataprice

    calc_image.setAttribute('src', option.getAttribute('image'))


    //     appreciation_percent
    // :
    // 21.13
    // appreciation_percent_description
    // :
    // "Ежегодная ставка удорожания"
    // deal_amount
    // :
    // 20076744.73
    // deal_amount_description
    // :
    // "Расчет сделан при условии, что оплата и поставка будут совершены в один месяц. На этапе подписания договора расчет может немного скорректироваться"
    // deal_amount_with_economy
    // :
    // 13384496.48
    // deal_amount_with_economy_description
    // :
    // "Сумма договора за вычетом экономии по налогам (если применимо к системе налогообложения)"
    // economy_tax_profit
    // :
    // 6692248.25
    // redemption_amount
    // :
    // 1200
    // regular_payment
    // :
    // 513668.09
    // const calcs = api_url + '/v1/partner/calcs';
    // let data = await fetch(calcs, {
    //   method: 'POST',
    //   headers: {
    //     'Accept': 'application/json',
    //     'Authorization': 'Bearer ' + window.access_token,
    //     'Partner-Id': 'f82ceceb-ce83-4f32-b0cf-c4316c05a832',
    //     // 'Content-Type': 'application/json',
    //   },
    //   mode: 'no-cors',
    //   credentials: 'include',
    //   body: JSON.stringify({
    //     "term": 36,
    //     "price": 5000000,
    //     "advance": {
    //       "percent": 15,
    //       "amount": 750000
    //     },
    //     "agent_commission": 2,
    //     "redemption_amount": 1200
    //   })
    // }).then(successResponse => { return successResponse.json() })



  }

  if (amount) {
    update_prepay()
    recalc()

    // On select product
    select_products.addEventListener("change", (e) => {
      update_prepay()
    })

    // Form submit
    form_calc.addEventListener('submit', async (e) => {

      e.preventDefault()
      e.stopPropagation()

      let now = new Date()

      let data = {

        "comment": document.querySelector("#comment").value,
        "timestamp": dayjs().format('YYYY-MM-DDTHH:mm:ssZ'),
        "action": "create",
        "model": "OAPI_CLAIMS_MODEL",
        "data": {
          "header": {
            "type_of_contractor": "LEGAL",
            "inn": document.querySelector('#inn').value
          },
          "contact_person": {
            "first_name": document.querySelector("#first-name").value,
            "middle_name": document.querySelector("#middle-name").value,
            "last_name": document.querySelector("#last-name").value,
            "phone": document.querySelector("#phone").value,
            "email": document.querySelector("#email").value,
          },
          "non_calculations": [{
            "comment": `Стоимость лизинга: ${from_rub(amount.value)}`
          }, {
            "comment": `Аванс: ${from_rub(prepay.value)}`
          }, {
            "comment": `Срок лизинга: ${duration.value}`
          }, {
            "comment": `Предмет: ${document.querySelector('title').textContent}`
          }],
          "creation_method": "MANUAL",
          "creator_type": "CONTRACTOR",
          "source": "OAPI"
        }
      }

      console.log('Sending:', data)
      let res = await fetch('/wp-content/plugins/calc-leasing/send_to_api.php',
        {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(data)
        }).then(
          successResponse => {
            console.log(successResponse.json())
            window.location = '/zayavka/lizing'
          },
          errorResponse => {
            console.log(errorResponse.text())
          }
        )

      console.log(res)
      // let data = await fetch(calcs, {
      //   method: 'POST',
      //   headers: {
      //     'Accept': 'application/json',
      //     'Authorization': 'Bearer ' + window.access_token,
      //     'Partner-Id': 'f82ceceb-ce83-4f32-b0cf-c4316c05a832',
      //     // 'Content-Type': 'application/json',
      //   },
      //   mode: 'no-cors',
      //   credentials: 'include',
      //   body: JSON.stringify({
      //     "term": 36,
      //     "price": 5000000,
      //     "advance": {
      //       "percent": 15,
      //       "amount": 750000
      //     },
      //     "agent_commission": 2,
      //     "redemption_amount": 1200
      //   })
      // })
      console.log(res)
      // const form = e.target
      // console.log(form)

      // let form_data = new FormData(form)

      // // form_data.append({ alphabank: data })

      // fetch(form.action, {
      //   method: form.method,
      //   body: new URLSearchParams(form_data),
      //   headers: {
      //     'Content-Type': 'application/x-www-form-urlencoded'
      //   }
      // }).then((result) => {
      //   console.log(result)
      // })

      // document.getElementById("r").innerHTML = "Будут переданы данные в Альфа-лизинг (JSON):<br><pre>" + JSON.stringify(data) + "</pre>"

    })

    /*Агенту необходимо передать в сторону Альфа-Лизинг следующие параметры:
    Обязательно:
    ● ИНН компании (10 знаков - ЮЛ, 12 знаков - ИП) – в параметре data.header.inn
    ● ФИО контактного лица. – в параметре data.contact_person.***
    o или раскладываете отдельно по полям last_name / first_name / middle_name (в данном случае обязательно передать хотя бы имя в first_name)
    o Или вы передаете ФИО в одно общее поле unrestricted_name, мы уже дальше сами раскладываем у себя в CRM (первый вариант работы приоритетнее).
    ● Телефон контактного лица – в параметр data.contact_person.phone
    ● Почту контактного лица (желательно, не обязательно) – в параметр data.contact_person.email
    ● Комментарий по заявке (ТИП предмета лизинга, срок, аванс, стоимость предмета лизинга, ежемесячный платеж, сумма договора лизинга, и какие то комментарии клиента – возможно о самом предмете лизинга и все что еще может быть полезно) – в параметре data.non_calculations.comment
    Из технических параметров также обязательно передать:
    ● Время создания заявки (в параметр timestamp)
    ● Действие для заявки (в параметр action) - [create]
    ● Метод создания заявки (в параметр data.creation_method) - [MANUAL]
    ● Кто отправляет заявку (в параметр data.creator_type) – что проставлять:
    o  [AGENT] - если отправляет заявку сам агент/менеджер агента (из CRM или личного кабинета),
    o [CONTRACTOR] - если сам лизингополучатель (с сайта агента)
    ● Источник заявки (в параметр data.source) - [OAPI]
    ● Модель (в параметр model) – [OAPI_CLAIMS_MODEL]
    */



    amount_range.addEventListener("input", function (e) {
      amount.value = formatCurrency(e.target.value)
      prepay.value = formatCurrency(e.target.value * document.getElementById("prepay-percent").value / 100)
      recalc()
    })

    amount_range.addEventListener("change", () => {
      recalc()
    })

    amount.addEventListener("change", function (e) {
      amount_range.value = toNumber(e.target.value)
      e.target.value = formatCurrency(e.target.value)
      prepay.value = formatCurrency(toNumber(amount.value) * toNumber(prepay_percent).value) / 100
      recalc()
    })

    prepay_range.addEventListener("input", function (e) {
      prepay.value = formatCurrency(toNumber(amount.value) * e.target.value / 100)
      prepay_percent.value = e.target.value
      recalc()
    })

    prepay.addEventListener("change", function (e) {
      e.target.value = formatCurrency(e.target.value)
      prepay_percent.value = toNumber(e.target.value) * 100 / toNumber(amount.value)
      prepay_range.value = prepay - percent.value
      recalc()
    })

    prepay_percent.addEventListener("change", function (e) {
      prepay_range.value = e.target.value
      prepay.value = formatCurrency(toNumber(amount.value) * e.target.value / 100)
      recalc()
    })

    duration_range.addEventListener("input", function (e) {
      duration.value = formatCurrency(e.target.value)
      recalc()
      //document.getElementById("prepay").value = formatCurrency(e.target.value * document.getElementById("prepay-percent").value / 100);
    })

    duration.addEventListener("change", function (e) {
      duration_range.value = toNumber(e.target.value)
      recalc()
      //e.target.value = formatCurrency(e.target.value);
      //document.getElementById("prepay").value = formatCurrency(toNumber(e.target.value) * document.getElementById("prepay-percent").value / 100);
    })
  }
})

