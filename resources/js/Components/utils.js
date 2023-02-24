const likeArticle = async ({article_id, source}) => {
  let response = await axios.put('/api/like', { article_id, source })
  return response.data
}

const saveArticle = async ({article_id, source}) => {
  let response = await axios.put('/api/save', { article_id, source })
  return response.data
}

const track = async ({article_id, source}) => {
  let response = await axios.post('/api/viewed', { article_id, source })
  return response.data
}

export { likeArticle, saveArticle, track }
