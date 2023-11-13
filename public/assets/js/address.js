const HOST = 'https://provinces.open-api.vn/api/'

const fetchData = async url => {
  const response = await axios.get(url)
  return response.data
}

const getListProvinces = () => fetchData(HOST)

const getListDistricts = provinceId =>
  fetchData(`${HOST}p/${provinceId}?depth=2`).then(data => data.districts)

const getListWards = districtId =>
  fetchData(`${HOST}d/${districtId}?depth=2`).then(data => data.wards)

const getFullByWardId = async wardId => {
  const [ward, district, province] = await Promise.all([
    fetchData(`${HOST}w/${wardId}`),
    fetchData(`${HOST}d/${ward.district_code}`),
    fetchData(`${HOST}p/${district.province_code}`),
  ])

  district.wards = ward
  province.districts = district

  return province
}

const renderOptions = async (selectElement, data, selectedId, selectName) => {
  selectElement.innerHTML =
    `<option value="" disabled selected>---CHỌN ${selectName.toUpperCase()}---</option>` +
    data.map(item => createOptionHTML(item, selectedId)).join('')
}

const createOptionHTML = (item, selectedId) => {
  const selected = item.code == selectedId ? 'selected' : ''
  return `<option value="${item.code}" ${selected}>${item.name}</option>`
}

const renderAddress = async () => {
  const provinceSelect = document.querySelector('#province')
  const districtSelect = document.querySelector('#district')
  const wardSelect = document.querySelector('#ward')

  // Render provinces
  const provinces = await getListProvinces()
  await renderOptions(provinceSelect, provinces, provinceSelect.dataset.id, 'tỉnh thành')

  // Render districts
  if (provinceSelect.dataset.id) {
    const districts = await getListDistricts(provinceSelect.dataset.id)
    await renderOptions(districtSelect, districts, districtSelect.dataset.id, 'quận huyện')
  }

  // Render wards
  if (districtSelect.dataset.id) {
    const wards = await getListWards(districtSelect.dataset.id)
    await renderOptions(wardSelect, wards, wardSelect.dataset.id, 'phường xã')
  }

  // Province selection change event
  provinceSelect.onchange = async () => {
    const selectedProvinceId = provinceSelect.value
    const districts = await getListDistricts(selectedProvinceId)
    await renderOptions(districtSelect, districts, districtSelect.dataset.id, 'quận huyện')
    await renderOptions(wardSelect, [], null, 'phường xã')
  }

  // District selection change event
  districtSelect.onchange = async () => {
    const selectedDistrictId = districtSelect.value
    const wards = await getListWards(selectedDistrictId)
    await renderOptions(wardSelect, wards, wardSelect.dataset.id, 'phường xã')
  }
}
