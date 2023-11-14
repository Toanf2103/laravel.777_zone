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

const getFullAddress = async (provinceId, districtId, wardId, type = 'array') => {
  const [province, district, ward] = await Promise.all([
    fetchData(`${HOST}p/${provinceId}`),
    fetchData(`${HOST}d/${districtId}`),
    fetchData(`${HOST}w/${wardId}`),
  ])

  delete district.wards
  delete province.districts
  district.ward = ward
  province.district = district

  if (type === 'string') {
    return `${province.district.ward.name}, ${province.district.name}, ${province.name}`
  } else if (type === 'array') {
    return province
  }
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

const renderAddress = async (provinceSelector, districtSelector, wardSelector) => {
  const provinceSelect = document.querySelector(provinceSelector)
  const districtSelect = document.querySelector(districtSelector)
  const wardSelect = document.querySelector(wardSelector)

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
