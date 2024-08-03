const ROOT = "http://localhost:8000/api";

export async function HttpClient(url, options = {}) {
  let queryParams = new URLSearchParams();
  
  for (const item in options.body) {
    queryParams.append(item, options.body[item]);
  }

  const data = await fetch(`${ROOT}${url}?${queryParams.toString()}`, {
    method: options.method ?? "POST",
  });

  return data;
}