package com.proyectofinal.importaciones;

import java.util.List;
import org.springframework.cloud.client.loadbalancer.LoadBalanced;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.core.ParameterizedTypeReference;
import org.springframework.http.HttpEntity;
import org.springframework.http.HttpMethod;
import org.springframework.http.HttpStatus;
import org.springframework.web.client.RestClientException;
import org.springframework.web.client.RestTemplate;
import org.springframework.web.server.ResponseStatusException;

@Configuration
public class CatalogoHttp {
    @Bean
    @LoadBalanced
    RestTemplate restTemplate() {
        return new RestTemplate();
    }

    @Bean
    CatalogoCliente catalogoCliente(RestTemplate restTemplate) {
        return productos -> {
            try {
                var respuesta = restTemplate.exchange(
                        "http://catalogo/api/productos/lotes",
                        HttpMethod.POST,
                        new HttpEntity<>(productos),
                        new ParameterizedTypeReference<List<ResultadoCatalogo>>() {});
                if (respuesta.getBody() == null || respuesta.getBody().size() != productos.size()) {
                    throw new ResponseStatusException(HttpStatus.BAD_GATEWAY, "El catálogo devolvió un lote incompleto");
                }
                return respuesta.getBody();
            } catch (RestClientException error) {
                throw new ResponseStatusException(HttpStatus.SERVICE_UNAVAILABLE, "No se pudo comunicar con el catálogo", error);
            }
        };
    }
}
