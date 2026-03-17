import "jsr:@supabase/functions-js/edge-runtime.d.ts";

const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Methods": "GET, POST, OPTIONS",
  "Access-Control-Allow-Headers": "Content-Type, Authorization, X-Client-Info, Apikey",
};

const OFF_BASE = "https://world.openfoodfacts.org";

Deno.serve(async (req: Request) => {
  if (req.method === "OPTIONS") {
    return new Response(null, { status: 200, headers: corsHeaders });
  }

  try {
    const url = new URL(req.url);
    const path = url.searchParams.get("path") || "";
    const query = url.searchParams.get("query") || "";
    const page = url.searchParams.get("page") || "1";
    const pageSize = url.searchParams.get("page_size") || "24";
    const grade = url.searchParams.get("nutrition_grade") || "";
    const code = url.searchParams.get("code") || "";

    let targetUrl = "";

    if (code) {
      const fields = "code,product_name,brands,categories,image_url,image_front_url,nutrition_grades,nutriments,ingredients_text,serving_size,nutriscore_score,nutriscore_grade";
      targetUrl = `${OFF_BASE}/api/v2/product/${code}?fields=${fields}`;
    } else {
      const searchTerm = query || "minuman";
      const fields = "code,product_name,brands,categories,image_url,image_front_url,nutrition_grades,nutriments,ingredients_text,serving_size,nutriscore_score,nutriscore_grade";
      targetUrl = `${OFF_BASE}/cgi/search.pl?search_terms=${encodeURIComponent(searchTerm)}&page=${page}&page_size=${pageSize}&json=true&fields=${fields}`;
      if (grade) {
        targetUrl += `&nutrition_grades_tags=${grade}`;
      }
    }

    const response = await fetch(targetUrl, {
      headers: {
        "User-Agent": "NutriCare/1.0 (nutricare-app)",
        "Accept": "application/json",
      },
    });

    const data = await response.json();

    return new Response(JSON.stringify(data), {
      status: 200,
      headers: {
        ...corsHeaders,
        "Content-Type": "application/json",
      },
    });
  } catch (error) {
    return new Response(
      JSON.stringify({ error: "Gagal mengambil data", detail: String(error) }),
      {
        status: 500,
        headers: {
          ...corsHeaders,
          "Content-Type": "application/json",
        },
      }
    );
  }
});
