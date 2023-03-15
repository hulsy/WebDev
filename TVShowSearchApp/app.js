const container = document.querySelector("#container");
const form = document.querySelector("#searchForm");
form.addEventListener("submit", async function (e) {
  e.preventDefault();
  const searchInput = form.elements.query.value;
  const config = { params: { q: searchInput } };
  const res = await axios.get(`https://api.tvmaze.com/search/shows`, config);
  createImages(res.data);
  form.elements.query.value = "";
});

const createImages = (shows) => {
  for (let search of shows) {
    if (search.show.image) {
      const img = document.createElement("IMG");
      img.src = search.show.image.medium;
      container.append(img);
    }
  }
};
